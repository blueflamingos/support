<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Components;

use Filament\Forms\Components;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Model;

class ModelInformation extends Card
{
    public static function make(array $schema = []): static
    {
        return parent::make([
            Components\Placeholder::make('created_at')
                ->label(__('Created At'))
                ->content(fn (?Model $record) => $record ? $record->created_at?->setTimezone('Europe/Amsterdam')->isoFormat('DD MMMM YYYY \o\m HH:mm') : '-'),

            Components\Placeholder::make('updated_at')
                ->label(__('Updated At'))
                ->content(fn (?Model $record) => $record ? $record->updated_at?->setTimezone('Europe/Amsterdam')->isoFormat('DD MMMM YYYY \o\m HH:mm') : '-'),

            Components\Placeholder::make('last_updated_by')
                ->content(fn (?Model $record) => $record?->last_updated_by ?? '-')
                ->label(__('Last updated by'))
                ->visible(function (?Model $record, $context) {
                    if ($context === 'create' || empty($record)) {
                        return false;
                    }

                    return in_array('Spatie\Activitylog\Traits\LogsActivity', class_uses_recursive($record));
                }),
        ]);
    }
}
