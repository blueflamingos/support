<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Tables\Columns;

use Filament\Tables\Columns\Column;

class Stack extends Column
{
    protected string $view = 'blueflamingos-support::filament.tables.columns.stack';

    protected array $columns = [];

    protected string $extraClasses = '';

    public function schema(array $array): self
    {
        foreach ($array as $value) {
            // Each field provides padding, we need to unset this as we cannot overwrite it with a class
            $value->extraAttributes([
                'style' => 'padding: unset',
            ]);
        }
        $this->columns = $array;

        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function extraClasses(string $extraClasses): self
    {
        $this->extraClasses = $extraClasses;

        return $this;
    }

    public function getExtraClasses(): string
    {
        return $this->extraClasses;
    }
}
