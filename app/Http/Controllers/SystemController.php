<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SystemController extends Controller
{
    /**
     * System settings page
     */
    public function index()
    {
        $maintenanceMode = app()->isDownForMaintenance();
        $backups = $this->getBackupFiles();
        $errorLogs = $this->getRecentErrorLogs(50);

        return view('admin.system.index', compact('maintenanceMode', 'backups', 'errorLogs'));
    }

    /**
     * Toggle maintenance mode
     */
    public function toggleMaintenance(Request $request)
    {
        try {
            if (app()->isDownForMaintenance()) {
                Artisan::call('up');
                $message = 'Maintenance mode dinonaktifkan. Website kembali online.';
            } else {
                Artisan::call('down', [
                    '--secret' => 'admin-bypass-' . time(),
                    '--render' => 'errors.503'
                ]);
                $message = 'Maintenance mode diaktifkan. Website sedang dalam perbaikan.';
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Maintenance toggle failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengubah status maintenance: ' . $e->getMessage());
        }
    }

    /**
     * Create database backup
     */
    public function createBackup()
    {
        try {
            $dbName = config('database.connections.mysql.database');
            $timestamp = now()->format('Y-m-d_H-i-s');
            $filename = "backup_{$dbName}_{$timestamp}.sql";
            $backupPath = storage_path('app/backups');

            // Create backup directory if not exists
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            $filePath = $backupPath . '/' . $filename;

            // Get all tables
            $tables = DB::select('SHOW TABLES');
            $tableKey = 'Tables_in_' . $dbName;

            $sql = "-- Database Backup\n";
            $sql .= "-- Generated: " . now()->format('Y-m-d H:i:s') . "\n";
            $sql .= "-- Database: {$dbName}\n\n";
            $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $tableName = $table->$tableKey;

                // Get create table statement
                $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
                $sql .= "-- Table: {$tableName}\n";
                $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
                $sql .= $createTable[0]->{'Create Table'} . ";\n\n";

                // Get table data
                $rows = DB::table($tableName)->get();

                if ($rows->count() > 0) {
                    $columns = array_keys((array) $rows->first());
                    $columnList = '`' . implode('`, `', $columns) . '`';

                    foreach ($rows as $row) {
                        $values = array_map(function ($value) {
                            if (is_null($value)) {
                                return 'NULL';
                            }
                            return "'" . addslashes($value) . "'";
                        }, (array) $row);

                        $sql .= "INSERT INTO `{$tableName}` ({$columnList}) VALUES (" . implode(', ', $values) . ");\n";
                    }
                    $sql .= "\n";
                }
            }

            $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Save to file
            File::put($filePath, $sql);

            return redirect()->back()->with('success', "Backup berhasil dibuat: {$filename}");

        } catch (\Exception $e) {
            Log::error('Backup failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    /**
     * Download backup file
     */
    public function downloadBackup($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);

        if (!File::exists($filePath)) {
            return redirect()->back()->with('error', 'File backup tidak ditemukan.');
        }

        return response()->download($filePath);
    }

    /**
     * Delete backup file
     */
    public function deleteBackup($filename)
    {
        $filePath = storage_path('app/backups/' . $filename);

        if (File::exists($filePath)) {
            File::delete($filePath);
            return redirect()->back()->with('success', 'Backup berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'File backup tidak ditemukan.');
    }

    /**
     * Get list of backup files
     */
    private function getBackupFiles()
    {
        $backupPath = storage_path('app/backups');

        if (!File::exists($backupPath)) {
            return collect();
        }

        $files = File::files($backupPath);

        return collect($files)->map(function ($file) {
            return [
                'name' => $file->getFilename(),
                'size' => $this->formatBytes($file->getSize()),
                'date' => date('Y-m-d H:i:s', $file->getMTime()),
            ];
        })->sortByDesc('date')->values();
    }

    /**
     * Get recent error logs
     */
    private function getRecentErrorLogs($lines = 100)
    {
        $logPath = storage_path('logs/laravel.log');

        if (!File::exists($logPath)) {
            return [];
        }

        try {
            $content = File::get($logPath);
            $allLines = explode("\n", $content);
            $recentLines = array_slice($allLines, -$lines);

            $logs = [];
            $currentLog = null;

            foreach ($recentLines as $line) {
                if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.*)$/', $line, $matches)) {
                    if ($currentLog) {
                        $logs[] = $currentLog;
                    }
                    $currentLog = [
                        'datetime' => $matches[1],
                        'environment' => $matches[2],
                        'level' => $matches[3],
                        'message' => $matches[4],
                        'stack' => ''
                    ];
                } else if ($currentLog && !empty(trim($line))) {
                    $currentLog['stack'] .= $line . "\n";
                }
            }

            if ($currentLog) {
                $logs[] = $currentLog;
            }

            return array_reverse(array_slice($logs, -20));

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Clear error logs
     */
    public function clearLogs()
    {
        $logPath = storage_path('logs/laravel.log');

        try {
            File::put($logPath, '');
            return redirect()->back()->with('success', 'Log berhasil dibersihkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membersihkan log: ' . $e->getMessage());
        }
    }

    /**
     * Format bytes to human readable
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
