<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface as ArticleInterface;

class ArticleRepository implements ArticleInterface
{
    function __construct(private Article $article)
    {
    }

    public function getAllArticles()
    {
        return $this->article;
    }

    public function getArticleById($id){}

    public function createArticle(array $data){}

    public function updateArticle($id, array $data){}

    public function deleteArticle($id){}
}
