<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
class CommentRepository implements CommentRepositoryInterface
{
    public function create(array $data)
    {
        return Comment::create($data);
    }

    public function delete($id)
    {
        return Comment::destroy($id);
    }
}