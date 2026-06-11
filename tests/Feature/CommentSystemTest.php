<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class CommentSystemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function reader_can_add_comment_to_article()
    {
        Notification::fake();

        $author = User::factory()->create();
        $reader = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $author->id,
        ]);

        $this->actingAs($reader);

        $response = $this->postJson('/api/v1/comments', [
            'commentable_id' => $article->id,
            'commentable_type' => Article::class,
            'body' => 'This is a valid comment',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('comments', [
            'body' => 'This is a valid comment',
            'user_id' => $reader->id,
            'commentable_id' => $article->id,
            'commentable_type' => Article::class,
        ]);
    }

    /** @test */
    public function it_sends_notification_to_article_owner_when_commented()
    {
        Notification::fake();

        $author = User::factory()->create();
        $reader = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $author->id,
        ]);

        $this->actingAs($reader);

        $this->postJson('/api/v1/comments', [
            'commentable_id' => $article->id,
            'commentable_type' => Article::class,
            'body' => 'Nice article',
        ]);

        Notification::assertSentTo(
            $author,
            NewCommentNotification::class
        );
    }

    /** @test */
    public function it_does_not_send_notification_when_owner_comments_his_own_article()
    {
        Notification::fake();

        $author = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $author->id,
        ]);

        $this->actingAs($author);

        $this->postJson('/api/v1/comments', [
            'commentable_id' => $article->id,
            'commentable_type' => Article::class,
            'body' => 'Self comment',
        ]);

        Notification::assertNothingSent();
    }
}