<?php

namespace App\Services\Hashing;

use Illuminate\Support\Facades\Hash;

class BcryptHashingStrategy implements HashingStrategyInterface
{
    public function hash(string $value): string
    {
        return Hash::make($value);
    }

    public function verify(string $value, string $hashValue): bool
    {
        return Hash::check($value, $hashValue);
    }
}
