<?php

namespace App\Services\Article;

use App\Models\Article;
use App\Repositories\Contracts\AttachmentRepositoryInterface;


class AttachmentService
{
    public function __construct(
        protected AttachmentRepositoryInterface $attachmentRepository
    ) {}

    public function upload($articleId, $file )
    {
        $article = Article::findOrFail($articleId);

        $path = $file->store('attachments');

        return $this->attachmentRepository->create([
            'file' => $path,
            'attachable_id' => $article->id,
            'attachable_type' => Article::class,
        ]);
    }

    public function update($id,$file)
{
    $attachment = $this->attachmentRepository->find($id);

$path = $file->store('attachments', 'local');
    return $this->attachmentRepository->update(
        $id,
        [
            'file' => $path
        ]
    );
}
}