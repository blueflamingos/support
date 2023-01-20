<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Pages\Actions\Action;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

trait HasCustomFormActions
{
    protected ?array $cachedCustomFormActions = null;

    protected bool $showOriginalFormActions = false;

    protected function getCachedCustomFormActions(): array
    {
        if ($this->cachedCustomFormActions === null) {
            $this->cacheCustomFormActions();
        }

        return $this->cachedCustomFormActions;
    }

    protected function cacheCustomFormActions(): void
    {
        $this->cachedCustomFormActions = [];

        foreach ($this->getCustomFormActions() as $action) {
            $action->livewire($this);

            $this->cachedCustomFormActions[$action->getName()] = $action;
        }
    }

    public function getCachedCustomFormAction(string $name): ?Action
    {
        return $this->getCachedCustomFormActions()[$name] ?? null;
    }

    protected function getFormActions(): array
    {
        return $this->showOriginalFormActions ? parent::getFormActions() : [];
    }

    protected function getCustomFormActions(): array
    {
        return parent::getFormActions();
    }

    protected function getActions(): array
    {
        if ($this instanceof EditRecord) {
            return [
                Actions\ActionGroup::make([
                    Actions\DeleteAction::make(),
                ]),
            ];
        }

        return [];
    }

    protected function getCreateFormAction(): Action
    {
        return parent::getCreateFormAction()
            ->color('success');
    }

    protected function getSubmitFormAction(): Action
    {
        return parent::getSubmitFormAction()
            ->color('success');
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()
            ->color('success');
    }

    protected function afterValidate(): void
    {
        $this->dispatchBrowserEvent('removeAlert');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->updateTimestamps();

        return parent::handleRecordUpdate($record, $data);
    }

    public function afterSave(): void
    {
        // Reload all relations (mostly because of activity log)
        $this->record = $this->record->refresh();
        // Fill the form again so all fields are properly populated with possible updated values
        $this->fillForm();
    }
}
