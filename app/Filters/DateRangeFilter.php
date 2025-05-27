<?php

namespace App\Filters;

use Closure;

class DateRangeFilter
{
    public function __construct(
        protected ?string $dateFrom,
        protected ?string $dateTo
    ) {}

    public function handle($query, Closure $next)
    {
        if ($this->dateFrom) {
            $query->whereDate('published_at', '>=', $this->dateFrom);
        }
        if ($this->dateTo) {
            $query->whereDate('published_at', '<=', $this->dateTo);
        }
        return $next($query);
    }
}