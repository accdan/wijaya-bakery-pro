<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class ClearHomepageCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-homepage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear homepage cached data (hero, sponsors, about, popular menu)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Clearing homepage cache...');

        $cacheKeys = [
            'homepage_hero',
            'homepage_sponsors',
            'homepage_about',
            'homepage_top_menus_' . now()->format('Y-m'),
        ];

        foreach ($cacheKeys as $key) {
            if (Cache::forget($key)) {
                $this->line("   ✓ Cleared: {$key}");
            } else {
                $this->warn("   ⚠ Not found: {$key}");
            }
        }

        $this->newLine();
        $this->info('✅ Homepage cache cleared successfully!');
        $this->comment('💡 Cache will be regenerated on next homepage visit.');

        return 0;
    }
}
