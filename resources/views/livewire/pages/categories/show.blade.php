<?php

use App\Enums\CategoryKind;
use App\Livewire\Forms\CategoryForm;
use App\Models\Category;

use function Livewire\Volt\{form, layout, mount};

form(CategoryForm::class);

layout('layouts.app');

mount(function (string $ulid) {
    $this->form->setCategory(auth()->user()->categories()->where('ulid', $ulid)->firstOrFail());
});

$save = function () {
    $category = $this->form->store();

    $this->redirect(route('categories.show', ['id' => $category->id]), navigate: true);
};

?>

<x-slot name="header">
    {{ __('Categories') }}
</x-slot>

<x-card :title="__('Create')">
    <form wire:submit="save">
        <div>
            <x-input-label for="kind" :value="__('Kind')"/>
            <select wire:model="form.kind" id="kind" class="block mt-1 w-full" name="kind" required>
                <option value="">{{ __('Please select an option') }}</option>
                @foreach(CategoryKind::cases() as $kind)
                    <option value="{{ $kind->value }}">{{ __("category.$kind->value") }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.kind')" class="mt-2"/>
        </div>
        <div>
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text" name="name"
                          required maxlength="255" autofocus/>
            <x-input-error :messages="$errors->get('form.name')" class="mt-2"/>
        </div>
        <div>
            <x-input-label for="color" :value="__('Color')"/>
            <x-color-picker wire:model="form.color" id="color" class="block mt-1 w-full" type="text" name="color"
                            required minlength="7" maxlength="7"/>
            <x-input-error :messages="$errors->get('form.color')" class="mt-2"/>
        </div>
        <div class="block mt-4">
            <label for="visible" class="inline-flex items-center">
                <input wire:model="form.visible" id="visible" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                       name="visible">
                <span class="ms-2 text-sm text-gray-600">{{ __('Visible') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save') }}

                <div wire:loading>
                    <x-spinner></x-spinner>
                </div>
            </x-primary-button>
        </div>
    </form>
</x-card>
