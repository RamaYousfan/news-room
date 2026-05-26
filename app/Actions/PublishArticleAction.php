<?php

namespace App\Actions;

use App\Models\Article;

class PublishArticleAction
{

    public function execute(
        Article $article
    )
    {

        $article
            ->update([

                'status'=>
                'published'

            ]);


        return $article;

    }

}