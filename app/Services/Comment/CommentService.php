<?php

namespace App\Services\Comment;

use App\Models\Article;
use App\Notifications\NewCommentNotification;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentService
{
    public function __construct(
        protected CommentRepositoryInterface $commentRepository ) {}

    public function create(array $data)
    {
        $data['user_id'] = auth()->id();

        $comment = $this->commentRepository->create(
            $data
        );

       $article = $comment->commentable;

        if (
            $article &&
            $article->user_id !== $comment->user_id
        ) {

            $article->author->notify(

                new NewCommentNotification(
                    $comment
                )

            );

        }

        return $comment;
    }

    public function delete($id)
    {
        return $this->commentRepository->delete(
            $id
        );
    }
}