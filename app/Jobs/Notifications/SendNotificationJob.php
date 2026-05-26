<?php

namespace App\Jobs\Notifications;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Notifications\AdminDatabaseNotification;
use App\Notifications\WriterEmailNotification;

class SendNotificationJob
implements ShouldQueue
{

    use Queueable;


    public function __construct(

        public $article

    ) {}



    public function handle(): void
    {

        $users =
        User::all();



        foreach(

            $users
            as
            $user

        ){

            if(

                $user->hasRole(

                    'admin'

                )

            ){

                $user->notify(

                    new
                    AdminDatabaseNotification(

                        $this->article

                    )

                );

            }



            if(

                $user->hasRole(

                    'writer'

                )

            ){

                $user->notify(

                    new
                    WriterEmailNotification(

                        $this->article

                    )

                );

            }

        }

    }

}