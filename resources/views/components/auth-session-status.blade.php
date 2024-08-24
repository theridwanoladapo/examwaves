@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-success']) }}>
        {{ $status }}
    </div>
@endif
