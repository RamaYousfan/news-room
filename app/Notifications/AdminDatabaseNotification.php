<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class AdminDatabaseNotification
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

            'database'

        ];

    }



    public function toArray(
        $notifiable
    )
    {

        return [

            'message'

            =>

            'Article Published',


            'article'

            =>

            $this

            ->article

            ?->title

        ];

    }

}