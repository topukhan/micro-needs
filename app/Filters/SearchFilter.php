<?php

namespace App\Filters;

use Closure;

class SearchFilter
{
    public function __construct(protected ?string $searchTerm) {}

    public function handle($query, Closure $next)
    {
        if ($this->searchTerm) {
            $query->whereAny(['title', 'content'], 'like', "%{$this->searchTerm}%");
        }

        return $next($query);
    }
}
