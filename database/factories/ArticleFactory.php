<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(6),
            'content' => fake()->paragraphs(5, true),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
            'published_at' => now(),
        ];
    }
}