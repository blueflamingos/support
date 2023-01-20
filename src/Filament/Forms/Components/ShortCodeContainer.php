<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Forms\Components;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;

class ShortCodeContainer extends Grid
{
    protected string $view = 'blueflamingos-support::filament.forms.components.shortcode-container';

    protected ?ShortCodeToolbar $toolbar;

    public static function make(int|array|null $columns = 1): static
    {
        return parent::make($columns);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // We set a parent x-data with an attribute that we can use within the children
        $this->extraAttributes(['x-data' => json_encode(['activeShortcodeElement' => null])]);

        $this->toolbar = ShortCodeToolbar::make('shortcode_toolbar');
    }

    public function getChildComponents(): array
    {
        $childComponents = parent::getChildComponents();

        foreach ($childComponents as $component) {
            // Add an on:click event so we know what the last target was the user selected
            // When the user clicks a shortcode button the focus is lost and we don't know where to put the shortcode
            if ($component instanceof RichEditor) {
                $component->extraAttributes([
                    'x-on:trix-focus' => 'activeShortcodeElement = $event.target;',
                ]);
            } else {
                $component->extraAttributes([
                    'x-on:click' => 'activeShortcodeElement = $event.target;',
                ]);
            }
        }

        $childComponents[] = $this->toolbar;

        return $this->evaluate($childComponents);
    }

    public function shortCodesForDeals(): static
    {
        $this->toolbar->shortCodesForDeals();

        return $this;
    }

    public function shortCodes(array|\Closure $shortCodes): static
    {
        $this->toolbar->shortCodes($shortCodes);

        return $this;
    }

    public function shortCodesAsHTML(bool $insertShortCodesAsHTML = true): static
    {
        $this->toolbar->shortCodesAsHTML($insertShortCodesAsHTML);

        return $this;
    }
}
