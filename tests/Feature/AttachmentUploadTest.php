<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttachmentUploadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_upload_attachment_to_article()
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $file = UploadedFile::fake()->create('file.pdf', 500, 'application/pdf');

        $response = $this->actingAs($user)
            ->postJson("/api/v1/articles/{$article->id}/attachments", [
                'attachment' => $file,
            ]);

        $response->assertStatus(201);

        Storage::disk('local')->assertExists('attachments/' . $file->hashName());

        $this->assertDatabaseHas('attachments', [
            'attachable_id' => $article->id,
            'attachable_type' => Article::class,
        ]);
    }

    /** @test */
    public function attachment_upload_requires_authentication()
    {
        Storage::fake('local');

        $article = Article::factory()->create();

        $file = UploadedFile::fake()->create('file.pdf', 500);

        $response = $this->postJson("/api/v1/articles/{$article->id}/attachments", [
            'attachment' => $file,
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function attachment_must_be_valid_file_type()
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $file = UploadedFile::fake()->create('file.exe', 500);

        $response = $this->actingAs($user)
            ->postJson("/api/v1/articles/{$article->id}/attachments", [
                'attachment' => $file,
            ]);

        $response->assertStatus(422);
    }
}