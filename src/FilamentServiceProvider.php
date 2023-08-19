<?php

declare(strict_types=1);

namespace Blueflamingos\Support;

use Filament\Navigation\UserMenuItem;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('blueflamingos-support')
            ->hasViews()
            ->hasConfigFile('blue-flamingos')
            ->hasRoutes('web');
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
