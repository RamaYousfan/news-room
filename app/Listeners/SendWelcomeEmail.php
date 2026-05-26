<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\WriterEmailNotification;

class SendWelcomeEmail
{
    public function handle(UserRegistered $event): void
    {
        $event->user->notify(
            new WriterEmailNotification(null)
        );
    }
}