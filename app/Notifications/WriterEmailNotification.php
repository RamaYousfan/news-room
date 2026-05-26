<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WriterEmailNotification
extends Notification
{

    public function __construct(
        public $article
    ) {}


    public function via(
        $notifiable
    )
    {

        return [

            'mail'

        ];

    }


    public function toMail(
        $notifiable
    )
    {

        return

        (new MailMessage)

        ->subject(

            'New Article'

        )

        ->line(

            $this
            ->article?->title

        );

    }

}