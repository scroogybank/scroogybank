@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-semibold text-gray-900 focus:outline-none hover:border-indigo-700 focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-normal text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if ($active)
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md bg-primary" aria-hidden="true"></span>
    @endif
    {{ $slot }}
</a>
