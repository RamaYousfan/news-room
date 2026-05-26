<?php

namespace App\Services\Notification;

use App\Models\User;
use App\Notifications\AdminDatabaseNotification;
use App\Notifications\WriterEmailNotification;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    public function notifyArticlePublished($article)
    {

        $users =
        User::all();


        foreach(
            $users as $user
        ){

            if(
                $user->hasRole(
                    'admin'
                )
            ){

                $user->notify(

                    new
                    AdminDatabaseNotification(

                        $article

                    )

                );

            }



            if(

                $user->hasRole(

                    'writer'

                )

            ){

                Notification::send(

                    $user,

                    new
                    WriterEmailNotification(

                        $article

                    )

                );

            }

        }

    }


    public function notifyWelcome(
        User $user
    )
    {

        $user->notify(

            new
            AdminDatabaseNotification(

                null

            )

        );

    }
}