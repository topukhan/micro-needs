<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleController extends Controller
{
    public function __construct(private ArticleRepositoryInterface $articleRepository)
    {
    }

    public function index()
    {
        return $this->articleRepository->getAllArticles();
    }
}
