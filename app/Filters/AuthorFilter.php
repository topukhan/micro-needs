<?php

namespace App\Filters;

use Closure;

class AuthorFilter
{
    public function __construct(protected ?int $authorId) {}

    public function handle($query, Closure $next)
    {
        if ($this->authorId) {
            $query->where('user_id', $this->authorId);
        }

        return $next($query);
    }
}
