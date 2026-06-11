<?php

use App\Models\User;
use App\Models\Article;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'writer']);
    Role::firstOrCreate(['name' => 'reader']);
});

it('guest cannot view articles', function () {

    $response = $this->getJson('/api/v1/articles');

    $response->assertStatus(401);

});

it('authenticated user can view articles', function () {

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    Article::factory()->count(3)->create();

    $response = $this->getJson('/api/v1/articles');

    $response->assertStatus(200);

});

it('reader cannot create article', function () {

    $user = User::factory()->create();

    $user->assignRole('reader');

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/v1/articles',
        [
            'title' => 'Valid Article Title Here',
            'content' => 'Valid content for testing',
            'status' => 'draft',
        ]
    );

    $response->assertStatus(403);

});

it('returns validation errors when data missing', function () {

    $user = User::factory()->create();

    $user->assignRole('writer');

    Sanctum::actingAs($user);

    $response = $this->postJson( '/api/v1/articles', []);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors([
        'title',
        'content',
        'status',
    ]);

});

it('writer can create article', function () {

    $user = User::factory()->create();

    $user->assignRole('writer');

    Sanctum::actingAs($user);

    $data = [

        'title' => 'This is a valid article title',

         'content' => fake()->paragraph(10),
        'status' => 'draft',

    ];

    $response = $this->postJson( '/api/v1/articles',  $data  );

    $response->assertStatus(201);

    $this->assertDatabaseHas(
        'articles',
        [
            'title' => 'This is a valid article title',
        ]
    );

});

it('admin can delete article with soft delete', function () {

    $admin = User::factory()->create();

    $admin->assignRole('admin');

    Sanctum::actingAs($admin);

    $article = Article::factory()->create();

    $response = $this->deleteJson( "/api/v1/articles/{$article->id}"
    );

    $response->assertStatus(200);

    $this->assertSoftDeleted('articles',
        [
            'id' => $article->id
        ]
    );

});