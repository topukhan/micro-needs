<?php

namespace App\Services;

use App\Services\Hashing\HashingStrategyInterface;

class HashingService
{
    public function __construct(private HashingStrategyInterface $hashingStrategy)
    {
    }

    public function hash(string $value): string
    {
        return $this->hashingStrategy->hash($value);
    }

    public function verify(string $value, string $hashValue): bool
    {
        return $this->hashingStrategy->verify($value, $hashValue);
    }
}
