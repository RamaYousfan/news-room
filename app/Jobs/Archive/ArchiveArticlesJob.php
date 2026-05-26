<?php

namespace App\Jobs\Archive;

use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ArchiveArticlesJob
implements ShouldQueue
{

    use Queueable;


    public function handle()
    {

        Article::

        where(

            'created_at',

            '<',

            now()
            ->subDays(30)

        )

        ->update([

            'status'=>
            'archived'

        ]);

    }

}