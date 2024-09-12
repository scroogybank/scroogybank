@props(['transaction'])

@php
$classes = 'text-xs px-2 mt-1 truncate';
@endphp

<p {{ $attributes->merge(['class' => $classes]) }}>
    {{ $transaction->name }}
</p>
