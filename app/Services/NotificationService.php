<?php

namespace App\Services;

use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification as FilamentNotification;
use Filament\Notifications\Actions\Action;

class NotificationService
{
    public function sendNotification($user, $title, $body)
    {
        FilamentNotification::make()
            ->title($title)
            ->success()
            ->body($body)
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(route('dashboard')),
            ])
            ->persistent()
            ->send()
            ->sendToDatabase($user);

        event(new DatabaseNotificationsSent($user));
    }
}
