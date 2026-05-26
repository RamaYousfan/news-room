<?php

namespace App\Services\Comment;

use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $commentRepository
    ) {}

    public function create(array $data)
    {
        return $this->commentRepository->create($data);
    }

    public function delete($id)
    {
        return $this->commentRepository->delete($id);
    }
}