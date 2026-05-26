<?php

namespace App\Listeners;

use App\Events\ArticlePublished;
use App\Services\Notification\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendArticleNotification implements ShouldQueue
{
    public function __construct(
        protected NotificationService $notificationService
    ) {}

    public function handle(ArticlePublished $event): void
    {
        $this->notificationService->notifyArticlePublished(
            $event->article
        );
    }
}