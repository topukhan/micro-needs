<?php

namespace App\Services;

use App\Services\Hashing\HashingStrategyInterface;

class HashingService
{
    private $hashingStrategy;

    public function __construct(HashingStrategyInterface $hashingStrategy)
    {
        $this->hashingStrategy = $hashingStrategy;
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
