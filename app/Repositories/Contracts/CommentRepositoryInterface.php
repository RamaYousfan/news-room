<?php

namespace App\Repositories\Contracts;

interface CommentRepositoryInterface
{
    public function create(array $data);
    public function delete($id);
}