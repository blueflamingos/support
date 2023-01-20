<div
    {{ $attributes->merge($getExtraAttributes())->class([
        'px-4 py-3 filament-tables-text-column',
        $getExtraClasses(),
        'text-primary-600 transition hover:underline hover:text-primary-500 focus:underline focus:text-primary-500' => $getAction() || $getUrl(),
    ]) }}
>
    @foreach ($getColumns() as $column)
        @php($column->record($getRecord()))
        @php($column->table($getTable()))

        {{$column}}
    @endforeach
</div>
