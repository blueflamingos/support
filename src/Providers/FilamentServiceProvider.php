<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Providers;

use Filament\PluginServiceProvider;
use Filament\Navigation\UserMenuItem;
use Spatie\LaravelPackageTools\Package;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('blueflamingos-support');
    }

    public function boot(): void
    {

    }
    protected function getUserMenuItems(): array
    {
        return [

            UserMenuItem::make()
                ->icon('heroicon-o-collection')
                ->label('Horizon')
                ->url('/horizon'),
        ];
    }
}
