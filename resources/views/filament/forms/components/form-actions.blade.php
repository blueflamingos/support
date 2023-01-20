@php
$actions = $this->getCachedCustomFormActions();
@endphp

@if (is_array($actions))
    @php
        $actions = array_filter(
            $actions,
            fn (\Filament\Pages\Actions\Action | \Filament\Pages\Actions\ActionGroup $action): bool => ! $action->isHidden(),
        );
    @endphp

    @if (count($actions))
        <div class="grid gap-2">
            @foreach ($actions as $action)
                {{ $action }}
            @endforeach
        </div>
    @endif
@endif
