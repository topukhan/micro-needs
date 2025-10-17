<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductSearchService
{
    public function search(string $query): array
    {
        $source = 'database';
        $results = null;

        if (config('scout.driver') === 'typesense') {
            try {
                $results = Product::search($query)->get();
                $source = 'typesense';
            } catch (\Throwable $e) {
                Log::warning('Typesense unavailable, fallback to DB search', [
                    'error' => $e->getMessage(),
                ]);
                $results = null;
                $source = 'database';
            }
        }

        if ($results && $results->count()) {
            return [
                'ids' => $results->pluck('id')->toArray(),
                'source' => $source,
            ];
        }

        return [
            'ids' => null,
            'source' => $source,
        ];
    }
}
