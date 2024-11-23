<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Event::listen(\Illuminate\Console\Events\CommandStarting::class, function ($event) {
            if (App::environment('production') && in_array($event->command, [
                'migrate:fresh',
                'migrate:reset',
                'migrate:rollback',
            ])) {
                echo "Command {$event->command} is disabled in production environment.\n";
                exit(1);
            }
        });
    }
}
