<?php

namespace App\Observers;

use App\Models\Article;
use App\Events\ArticlePublished;
use App\Events\ArticleUpdated;

class ArticleObserver
{

    public function created(
        Article $article
    ): void
    {

        if(

            $article->status
            === 'published'

        ){

            event(

                new ArticlePublished(
                    $article
                )

            );

        }

    }



    public function updated(
        Article $article
    ): void
    {

        event(

            new ArticleUpdated(
                $article
            )

        );

    }

}