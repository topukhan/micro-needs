<?php

namespace App\Filters;

use Closure;

class PublishedFilter
{
    public function __construct(protected ?bool $isPublished) {}

    public function handle($query, Closure $next)
    {
        if ($this->isPublished !== null) {
            $query->where('is_published', $this->isPublished);
        }

        return $next($query);
    }
}
