<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;
use App\Mail\ArticlePublishedMail;
use App\Jobs\NotifySubscribersJob;

class ArticlePublishingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_confirmation_email_to_writer_when_article_is_published()
    {
        Mail::fake();

        $writer = User::factory()->create([
            'role' => 'writer',
        ]);

        $article = Article::factory()->create([
            'user_id' => $writer->id,
            'status' => 'draft',
        ]);

        $this->actingAs($writer)
            ->postJson("/api/v1/articles/{$article->id}/publish")
            ->assertStatus(200);

        Mail::assertQueued(ArticlePublishedMail::class, function ($mail) use ($writer) {
            return $mail->hasTo($writer->email);
        });
    }

    /** @test */
    public function it_dispatches_subscribers_notification_job_when_article_is_published()
    {
        Bus::fake();

        $writer = User::factory()->create([
            'role' => 'writer',
        ]);

        $article = Article::factory()->create([
            'user_id' => $writer->id,
            'status' => 'draft',
        ]);

        $this->actingAs($writer)
            ->postJson("/api/v1/articles/{$article->id}/publish")
            ->assertStatus(200);

        Bus::assertDispatched(NotifySubscribersJob::class, function ($job) use ($article) {
            return isset($job->article) && $job->article->id === $article->id;
        });
    }

    /** @test */
    public function it_updates_article_status_to_published()
    {
        $writer = User::factory()->create([
            'role' => 'writer',
        ]);

        $article = Article::factory()->create([
            'user_id' => $writer->id,
            'status' => 'draft',
        ]);

        $this->actingAs($writer)
            ->postJson("/api/v1/articles/{$article->id}/publish")
            ->assertStatus(200);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'status' => 'published',
        ]);
    }
}