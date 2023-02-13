<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Forms\Components;

use Blueflamingos\Support\Filament\Components\ModelInformation;
use Closure;
use Filament\Forms\Components;

class DefaultForm extends Components\Grid
{
    protected ?Components\Group $main;

    protected ?Components\Group $aside;

    protected $modelInformation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->main = Components\Group::make()
            ->columnSpan(['lg' => 2]);

        $this->aside = Components\Group::make()
            ->extraAttributes(['class' => 'sticky top-10'])
            ->columnSpan(['lg' => 1])
            ->schema([
                $this->modelInformation ?? ModelInformation::make(),

                FormActions::make(),
            ]);

        $this->schema([
            $this->main,
            $this->aside,
        ]);
    }

    public static function make(array | int | null $columns = 3): static
    {
        return parent::make($columns);
    }

    public function main(array|Closure $components): static
    {
        $this->main->schema($components);

        return $this;
    }

    public function aside(array|Closure $components): static
    {
        $this->aside->schema($components);

        return $this;
    }

    public function modelInformation($modelInformation): static
    {
        $this->modelInformation = $modelInformation;

        return $this;
    }
}
