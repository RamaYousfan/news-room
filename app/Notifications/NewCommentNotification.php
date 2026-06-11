<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewCommentNotification extends Notification
{
    public function __construct(
        public $comment
    ) {}

    public function via($notifiable): array
    {
        if ($notifiable->hasRole('admin')) {
            return ['database'];
        }

        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Comment')
            ->line('A new comment was added.');
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => 'New Comment'
        ];
    }
}