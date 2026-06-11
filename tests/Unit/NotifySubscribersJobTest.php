<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Jobs\NotifySubscribersJob;
use App\Models\Article;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifySubscribersJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_implements_should_queue()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $job = new NotifySubscribersJob($article);

        $this->assertInstanceOf(
            ShouldQueue::class,
            $job
        );
    }

    /** @test */
    public function it_receives_article_instance()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $job = new NotifySubscribersJob($article);

        $this->assertEquals(
            $article->id,
            $job->article->id
        );
    }

    /** @test */
    public function handle_method_executes_without_errors()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $job = new NotifySubscribersJob($article);

        $job->handle();

        $this->assertTrue(true);
    }
}