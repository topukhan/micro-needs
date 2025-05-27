<?php

namespace App\Repositories;

use App\Filters\AuthorFilter;
use App\Filters\DateRangeFilter;
use App\Filters\PublishedFilter;
use App\Filters\SearchFilter;
use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface as ArticleInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pipeline\Pipeline;

class ArticleRepository implements ArticleInterface
{
    public function __construct(protected Article $article) {}

    public function getAllWithFilters(array $filters = [], int $perPage = 15): Paginator
    {
        return app(Pipeline::class)
            ->send($this->article->query())
            ->through([
                new PublishedFilter($filters['is_published'] ?? null),
                new DateRangeFilter($filters['date_from'] ?? null, $filters['date_to'] ?? null),
                new SearchFilter($filters['search'] ?? null),
                new AuthorFilter($filters['author_id'] ?? null),
            ])
            ->thenReturn()
            ->with('user')
            ->paginate($perPage);
    }

    public function getArticleById(int $id): ?Article
    {
        return $this->article->with('user')->findOrFail($id);
    }

    public function createArticle(array $data): Article
    {
        return $this->article->create($data);
    }

    public function updateArticle($id, array $data): Article
    {
        $article = $this->getArticleById($id);
        if (!$article) {
            throw new ModelNotFoundException("Article not found");
        }
        $article->update($data);
        return $article;
    }

    public function deleteArticle($id): bool
    {
        $article = $this->getArticleById($id);
        if (!$article) {
            throw new ModelNotFoundException("Article not found");
        }
        
        return $article->forceDelete();
    }
}
