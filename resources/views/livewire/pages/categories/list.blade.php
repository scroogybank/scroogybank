<?php

use function Livewire\Volt\layout;

layout('layouts.app');

?>

<x-slot name="header">
    {{ __('Categories') }}
</x-slot>

<x-card>
    <x-slot:topSideButtons>
        <div class="inline-block float-right">
            <x-responsive-nav-link href="{{ route('categories.create') }}" wire:navigate>
                <x-primary-button type="button">
                    {{ __('category.Add new') }}
                </x-primary-button>
            </x-responsive-nav-link>
        </div>
    </x-slot:topSideButtons>

    <livewire:categories-table></livewire:categories-table>
</x-card>
