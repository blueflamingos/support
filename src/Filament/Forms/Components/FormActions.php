<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class FormActions extends Field
{
    protected string $view = 'forms.components.form-actions';

    public static function make(?string $name = null): static
    {
        return parent::make('form actions')
            ->dehydrated(false);
    }
}
