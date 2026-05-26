<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource
extends JsonResource
{

    public function toArray(
        Request $request
    ): array
    {

        return [

            'id'=>$this->id,


            'title'=>$this->title,


            'content'=>$this->content,


            'author'=>$this->author?->name,


            'published_at'=>$this->published_at,


            'comments_count'=>$this->comments_count,


            'tags'=>

            $this->tags,


            'reading_time'=>

            ceil(

                str_word_count(

                    $this->content

                )

                /200

            )

        ];

    }

}