<?php

namespace App\Repositories\Interfaces;

use App\Models\Article;
use Illuminate\Contracts\Pagination\Paginator;

interface ArticleRepositoryInterface
{
    public function getAllWithFilters(array $filters = [], int $perPage = 15): Paginator;
    public function getArticleById(int $id): ?Article;
    public function getRelatedArticles(Article $article, int $limit = 5);
    public function createArticle(array $data): Article;
    public function updateArticle(int $id, array $data): Article;
    public function deleteArticle(int $id): bool;
}
