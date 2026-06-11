<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function all()
    {
        return Article::with(['author', 'comments.user', 'tags', 'attachments'])->get();
    }

    public function find($id)
    {
        return Article::with(['author', 'comments.user', 'tags', 'attachments'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Article::create($data);
    }

    public function update($id, array $data)
    {
        $article = Article::findOrFail($id);
        $article->update($data);

        return $article;
    }

    public function delete($id)
    {
      $article = Article::findOrFail($id);
      return $article->delete();
    }
}