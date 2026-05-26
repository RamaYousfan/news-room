<?php

namespace App\Actions;

use App\Models\Article;

class ArchiveArticleAction
{

    public function execute(
        Article $article
    )
    {

        $article
            ->update([

                'status'=>
                'archived'

            ]);


        return $article;

    }

}