<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Services\Comment\CommentService;
use App\Traits\ApiResponse;

class CommentController extends Controller
{  use ApiResponse;
    public function __construct(
        protected CommentService $commentService
    ) {}

public function store(
    StoreCommentRequest $request
)
{
    $comment = $this->commentService->create(
        $request->validated()
    );

   return $this->success($comment, 'Comment created', 201);
}

    public function destroy($id)
    {
        return  $this->commentService->delete($id);

       return $this->success(null, 'Comment deleted');
    }
}