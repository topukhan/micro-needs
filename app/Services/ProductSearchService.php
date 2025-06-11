<?php

namespace App\Services;

use App\Models\Product;

class ProductSearchService
{
    public function search(string $query)
    {
        if (config('scout.driver') === 'typesense') {
            $results = Product::search($query)->get();
            return $results->pluck('id')->toArray();
        }

        // fallback to default MySQL-like search: return null
        return null;
    }
}
