<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use App\Models\User;
use App\Mail\ArticlePublishedMail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlePublishedMailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_correct_subject()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $mail = new ArticlePublishedMail($article);

        $this->assertEquals(
            'Article Published',
            $mail->envelope()->subject
        );
    }

    /** @test */
    public function it_contains_expected_html_content()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $mail = new ArticlePublishedMail($article);

        $content = $mail->content();

        $this->assertStringContainsString(
            'Article Published',
            $content->htmlString
        );

        $this->assertStringContainsString(
            'Your article has been published successfully.',
            $content->htmlString
        );
    }

    /** @test */
    public function it_receives_article_instance()
    {
        $user = User::factory()->create();

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $mail = new ArticlePublishedMail($article);

        $this->assertEquals(
            $article->id,
            $mail->article->id
        );
    }
}