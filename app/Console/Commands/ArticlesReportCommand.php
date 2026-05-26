<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ArticlesReportCommand
extends Command
{

    protected $signature=

    'articles:report';


    protected $description=

    'Articles report';



    public function handle()
    {

        $writers=

        User::withCount(

            'articles'

        )->get();


        foreach(

            $writers as $writer

        ){

            $text=

            $writer->name

            .' => '

            .$writer->articles_count;



            $this->info(

                $text

            );


            Log::info(

                $text

            );

        }

    }

}