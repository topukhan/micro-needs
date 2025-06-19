<?php

namespace App\Filters\Product;

use Closure;

class CategoryFilter
{
    public function handle($request, Closure $next)
    {
        $query = $next($request);

        if (request()->filled('category')) {
            $query->where('category', request('category'));
        }

        return $query;
    }
}
