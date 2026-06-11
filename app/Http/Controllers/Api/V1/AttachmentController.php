<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreAttachmentRequest;
use App\Http\Requests\Article\UpdateAttachmentRequest;
use App\Http\Resources\V1\AttachmentResource;
use App\Services\Article\AttachmentService;
use App\Models\Article;
use App\Traits\ApiResponse;

class AttachmentController extends Controller
{   use ApiResponse;
    public function __construct(
        protected AttachmentService $attachmentService
    ) {}

    public function store(StoreAttachmentRequest $request, Article $article)
    {
        $attachment = $this->attachmentService->upload(
            $article->id,
            $request->file('attachment')
        );

       return $this->success(new AttachmentResource($attachment),'Attachment uploaded', 201);
    }

    public function update(UpdateAttachmentRequest $request, $id)
    {
        $attachment = $this->attachmentService->update(
            $id,
            $request->file('attachment')
        );

     return $this->success(new AttachmentResource($attachment),'Attachment updated');
    }
}