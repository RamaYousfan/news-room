<?php

namespace App\Services\Article;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Events\ArticlePublished;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository
    ) {}

    public function getAll()
    {
        return $this->articleRepository->all();
    }

    public function getById($id)
    {
        return $this->articleRepository->find($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {

            $data['user_id'] = auth()->id();

            $article = $this->articleRepository->create($data);

            if (isset($data['tags'])) {
                $article->tags()->sync($data['tags']);
            }

            if (($data['status'] ?? null) === 'published') {
                event(new ArticlePublished($article));
            }

            return $article;
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {

            $article = $this->articleRepository->update($id, $data);

            if (isset($data['tags'])) {
                $article->tags()->sync($data['tags']);
            }

            if (($data['status'] ?? null) === 'published') {
                event(new ArticlePublished($article));
            }

            return $article;
        });
    }

    public function delete($id)
    {
        return $this->articleRepository->delete($id);
    }
}