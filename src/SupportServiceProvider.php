<?php

declare(strict_types=1);

namespace Blueflamingos\Support;

use Illuminate\Support\ServiceProvider;
use Blueflamingos\Support\Providers\FilamentServiceProvider;

class SupportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        dd('ere');
    }

    public function register(): void
    {
        dd('ere');
        $this->app->register(FilamentServiceProvider::class);
    }

}
