<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Article;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $articles = Article::all();

        foreach ($articles as $article) {
            Comment::create([
                'user_id' => $users->random()->id,
                'body' => fake()->sentence(10),
                'commentable_id' => $article->id,
                'commentable_type' =>Article::class,
            ]);
        }
    }
}