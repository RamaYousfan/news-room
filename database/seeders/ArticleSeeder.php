<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Tag;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = Article::factory(10)->create();

        $tags = Tag::all();

        foreach ($articles as $article) {
            $article->tags()->attach(
                $tags->random(2)->pluck('id')->toArray()
            );
        }
    }
}