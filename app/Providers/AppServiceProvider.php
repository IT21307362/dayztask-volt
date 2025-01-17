<?php

namespace App\Providers;

use App\Services\Notifications\NotificationService;
use App\Services\Task\TaskService;
use Filament\Notifications\Livewire\DatabaseNotifications;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Amber,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);

        DatabaseNotifications::trigger('filament.notifications.database-notifications-trigger');
        DatabaseNotifications::pollingInterval('30s');

        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService;
        });

        $this->app->singleton(TaskService::class, function ($app) {
            return new TaskService;
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
