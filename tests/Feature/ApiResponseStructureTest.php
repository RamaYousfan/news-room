<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiResponseStructureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function articles_list_has_expected_structure()
    {
        $user = User::factory()->create();

        Article::factory()->count(3)->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
            ->getJson('/api/v1/articles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content',
                        'author',
                        'published_at',
                    ]
                ]
            ]);
    }

    /** @test */
    public function article_details_do_not_expose_sensitive_data()
    {
        $user = User::factory()->create([
            'password' => bcrypt('secret')
        ]);

        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
            ->getJson("/api/v1/articles/{$article->id}");

        $response->assertStatus(200);

        $response->assertJsonMissing([
            'password' => $user->password
        ]);

        $response->assertJsonMissingPath('data.password');
    }
}