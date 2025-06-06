<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function __construct(private ArticleRepositoryInterface $repository)
    {
    }

    public function index(Request $request)
    {
        try {
            $articles = $this->repository->getAllWithFilters($request->all());
            $categories = null;
            // return $this->successResponse($articles);
            return view('article.index', compact('articles', 'categories'));
        } catch (\Exception $e) {
            Log::error("Article index error: " . $e->getMessage());
            return $this->errorResponse("Server error", 500);
        }
    }

    public function create()
    {
        return view('article.create');
    }

    public function show(int $id)
    {
        $article = $this->repository->getArticleById($id);
        $relatedArticles = $this->repository->getRelatedArticles($article, 5);

        return view('article.show', compact('article', 'relatedArticles'));
        // return $this->successResponse($article);
    }

    public function store(ArticleRequest $request)
    {
        $article = $this->repository->createArticle($request->validated());
        return $this->successResponse(message:'Article created successfully', redirect:route('articles.show', $article->id));
    }

    public function update(ArticleRequest $request, int $id)
    {
        try {
            $article = $this->repository->updateArticle($id, $request->validated());
            return $this->successResponse($article);
        } catch (\Exception $e) {
            Log::error("Article update error: " . $e->getMessage());
            return $this->errorResponse("Server error", 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->repository->deleteArticle($id);
            return $this->successResponse(null, 204);
        } catch (\Exception $e) {
            Log::error("Article delete error: " . $e->getMessage());
            return $this->errorResponse("Server error", 500);
        }
    }

    public function ForceDelete(int $id)
    {
        try {
            $this->repository->deleteArticle($id);
            return $this->successResponse(null, 204);
        } catch (\Exception $e) {
            Log::error("Article force delete error: " . $e->getMessage());
            return $this->errorResponse("Server error", 500);
        }
    }
}
