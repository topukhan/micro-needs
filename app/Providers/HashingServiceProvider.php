<?php

namespace App\Providers;

use App\Services\Hashing\BcryptHashingStrategy;
use App\Services\Hashing\HashingStrategyInterface;
use Illuminate\Support\ServiceProvider;

class HashingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HashingStrategyInterface::class, BcryptHashingStrategy::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
