<?php

namespace App\Filters\Product;

use App\Services\ProductSearchService;
use Closure;

class SearchFilter
{
    public function __construct(private ProductSearchService $searchService)
    {
        //
    }
    public function handle($request, Closure $next)
    {
        $query = $next($request);

        if (request()->filled('search')) {
            $search = request('search');
            $searchResultIds = $this->searchService->search($search);

            if (is_array($searchResultIds)) {
                $query->whereIn('id', $searchResultIds);
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%")
                        ->orWhere('brand', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            }
        }

        return $query;
    }
}
