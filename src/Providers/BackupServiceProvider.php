<?php

namespace Juzaweb\Backup\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Juzaweb\Backup\Actions\BackupAction;
use Juzaweb\CMS\Support\ServiceProvider;

class BackupServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerHookActions([BackupAction::class]);

        $this->app->booted(
            function () {
                $schedule = $this->app->make(Schedule::class);

                if (get_config('jw_backup_enable')) {
                    $schedule->command('backup:clean')->daily();
                    $time = get_config('jw_backup_time', 'daily');

                    switch ($time) {
                        case 'weekly':
                            $schedule->command('backup:run')->weekly();
                            break;
                        case 'monthly':
                            $schedule->command('backup:run')->monthly();
                            break;
                        default:
                            $schedule->command('backup:run')->daily();
                    }
                }
            }
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
