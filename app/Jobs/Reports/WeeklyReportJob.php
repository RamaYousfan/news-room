<?php

namespace App\Jobs\Reports;

use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class WeeklyReportJob
implements ShouldQueue
{

    use Queueable;


    public function handle()
    {

        $count =
        Article::count();


        Log::info(

            'Weekly Report',

            [

                'articles'=>
                $count

            ]

        );

    }

}