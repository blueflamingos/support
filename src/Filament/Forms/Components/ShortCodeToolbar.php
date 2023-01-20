<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Forms\Components;

use Blueflamingos\Support\Filament\Components\Concerns\InteractsWithShortCodes;
use Closure;
use Filament\Forms\Components\Field;

class ShortCodeToolbar extends Field
{
    use InteractsWithShortCodes;

    protected string $view = 'blueflamingos-support::filament.forms.components.shortcode-toolbar';

    protected array | Closure $shortCodes = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrated(false);
    }

    public function shortCodesForDeals(): static
    {
        return $this->shortCodes([
            '[verzorging]'         => '[verzorging]',
            '[prijs]'              => '<b>€[prijs]</b>',
            '[datum]'              => '<b>[datum]</b>',
            '[vertrekluchthaven]'  => '[vertrekluchthaven]',
            '[aankomstluchthaven]' => '[aankomstluchthaven]',
            '[daagse]'             => '<b>[daagse]</b>',
            '[dagen]'              => '<b>[dagen]</b>',
            '[reisgezelschap]'     => '[reisgezelschap]',
        ]);
    }
}
