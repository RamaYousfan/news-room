<?php

namespace App\Services\Notification;

use App\Models\User;
use App\Mail\ArticlePublishedMail;
use App\Jobs\NotifySubscribersJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminDatabaseNotification;
use App\Notifications\WriterEmailNotification;

class NotificationService
{
    public function notifyArticlePublished($article)
    {
        $users = User::all();

        foreach ($users as $user) {

            if ($user->hasRole('admin')) {

                $user->notify(
                    new AdminDatabaseNotification($article)
                );
            }

            if ($user->hasRole('writer')) {

                Notification::send(
                    $user,
                    new WriterEmailNotification($article)
                );

                Mail::to($user)
                    ->queue(
                        new ArticlePublishedMail($article)
                    );

                NotifySubscribersJob::dispatch(
                    $article
                );
            }
        }
    }

    public function notifyWelcome(User $user)
    {
        $user->notify(
            new AdminDatabaseNotification(null)
        );
    }
}