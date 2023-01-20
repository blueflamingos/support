<?php

declare(strict_types=1);

namespace Blueflamingos\Support;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadJsonTranslationsFrom(__DIR__ . '/../lang');
    }

    public function register(): void
    {
        $this->app->register(FilamentServiceProvider::class);
    }
}
