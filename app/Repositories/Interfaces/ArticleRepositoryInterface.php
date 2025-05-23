<?php

namespace App\Repositories\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAllArticles();

    public function getArticleById($id);

    public function createArticle(array $data);

    public function updateArticle($id, array $data);

    public function deleteArticle($id);
}
