<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Model;

class Badge extends Field
{
    protected string $view = 'forms.components.badge';

    protected string | Closure | null $color = null;

    protected string | Closure | null $icon = null;

    protected string | Closure | null $iconPosition = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dehydrated(false);
    }

    public function color(string | Closure | null $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function colors(array | Closure $colors): static
    {
        $this->color(function (?Model $record, $state) use ($colors) {
            $stateColor = null;

            foreach ($colors as $color => $condition) {
                if (is_numeric($color)) {
                    $stateColor = $condition;
                } elseif ($condition instanceof Closure && $condition($state, $record)) {
                    $stateColor = $color;
                } elseif ($condition === $state) {
                    $stateColor = $color;
                }
            }

            return $stateColor;
        });

        return $this;
    }

    public function getStateColor(): ?string
    {
        return $this->evaluate($this->color, [
            'state' => $this->getState(),
        ]);
    }
    public function icon(string | Closure | null $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function icons(array | Closure $icons): static
    {
        $this->icon(function (Component $component, Model $record, $state) use ($icons) {
            $icons = $component->evaluate($icons);
            $stateIcon = null;

            foreach ($icons as $icon => $condition) {
                if (is_numeric($icon)) {
                    $stateIcon = $condition;
                } elseif ($condition instanceof Closure && $condition($state, $record)) {
                    $stateIcon = $icon;
                } elseif ($condition === $state) {
                    $stateIcon = $icon;
                }
            }

            return $stateIcon;
        });

        return $this;
    }

    public function iconPosition(string | Closure | null $iconPosition): static
    {
        $this->iconPosition = $iconPosition;

        return $this;
    }

    public function getStateIcon(): ?string
    {
        return $this->evaluate($this->icon, [
            'state' => $this->getState(),
        ]);
    }

    public function getIconPosition(): string
    {
        return $this->evaluate($this->iconPosition) ?? 'before';
    }
}
