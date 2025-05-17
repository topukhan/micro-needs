<?php

namespace App\Services\Hashing;

interface HashingStrategyInterface
{
    public function hash(string $value): string;
    public function verify(string $value, string $hashValue): bool;
}
