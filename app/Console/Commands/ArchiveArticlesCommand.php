<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;

class ArchiveArticlesCommand
extends Command
{

    protected $signature=

    'articles:archive
    {days=30}';


    protected $description=
    'Archive articles';


    public function handle()
    {

        $days=
        $this->argument(
            'days'
        );


        Article::

        where(

            'created_at',

            '<',

            now()
            ->subDays($days)

        )

        ->update([

            'status'=>
            'archived'

        ]);


        $this->info(

            'Archived'

        );

    }

}