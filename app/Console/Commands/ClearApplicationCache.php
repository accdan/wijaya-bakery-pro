<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearApplicationCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-app {--type=all : Type of cache to clear (all, homepage, categories, menus)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application-specific caches (homepage, categories, menus)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->option('type');

        $this->info('🧹 Clearing application cache...');
        $this->newLine();

        switch ($type) {
            case 'homepage':
                $this->clearHomepageCache();
                break;

            case 'categories':
                $this->clearCategoriesCache();
                break;

            case 'menus':
                $this->clearMenusCache();
                break;

            case 'all':
            default:
                $this->clearHomepageCache();
                $this->clearCategoriesCache();
                $this->clearMenusCache();
                break;
        }

        $this->newLine();
        $this->info('✅ Application cache cleared successfully!');
        $this->comment('💡 Cache will be regenerated on next request.');

        return 0;
    }

    /**
     * Clear homepage cache
     */
    protected function clearHomepageCache()
    {
        $this->line('🏠 <fg=yellow>Homepage Cache</>');

        $keys = [
            'homepage_hero',
            'homepage_sponsors',
            'homepage_about',
            'homepage_top_menus_' . now()->format('Y-m'),
        ];

        foreach ($keys as $key) {
            if (Cache::forget($key)) {
                $this->line("   ✓ Cleared: {$key}");
            }
        }
    }

    /**
     * Clear categories cache
     */
    protected function clearCategoriesCache()
    {
        $this->line('📂 <fg=yellow>Categories Cache</>');

        if (Cache::forget('all_categories')) {
            $this->line("   ✓ Cleared: all_categories");
        }
    }

    /**
     * Clear menus cache (if any added in future)
     */
    protected function clearMenusCache()
    {
        $this->line('🍞 <fg=yellow>Menus Cache</>');
        $this->line("   ℹ No menu-specific cache configured yet");
    }
}
