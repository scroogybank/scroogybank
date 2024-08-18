<?php

use Illuminate\Support\Carbon;
use function Livewire\Volt\layout;
use function Livewire\Volt\{computed, state};

layout('layouts.app');

state([
    'firstDayOfMonth' => Carbon::now()->startOfMonth(),
    // TODO: start day may change depending on settings
    'daysOfTheWeekShort' => ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
    'colStartClasses' => [
        "",
        "col-start-1 ",
        "col-start-2 ",
        "col-start-3 ",
        "col-start-4 ",
        "col-start-5 ",
        "col-start-6 ",
        "col-start-7 ",
    ],
    // TODO: get current month transactions from database
    'transactions' => fn () => []
]);

$allDaysInMonth = computed(function(): array {
    $start = (new Carbon($this->firstDayOfMonth))->startOfMonth()->startOfWeek();
    $end = (new Carbon($this->firstDayOfMonth))->endOfMonth()->endOfWeek();
    $days = [];
    while ($start->lessThanOrEqualTo($end)) {
        $days[] = clone $start;
        $start->addDay();
    }

    return $days;
});

$changeMonth = function(int $addMonth): void {
    if ($addMonth === 0) {
        $this->firstDayOfMonth = Carbon::now()->startOfMonth();
        return;
    }
    $this->firstDayOfMonth = $this->firstDayOfMonth->addMonth($addMonth);

    // Reset computed property
    unset($this->allDaysInMonth);
};

// TODO: navigate to transaction detail page
$openTransactionDetail = function(string $ulid): void {
};

?>

<x-slot name="header">
{{ __('Transactions calendar') }}
</x-slot>

<div class="w-full bg-base-100 p-4 rounded-lg">
    <div class="flex items-center justify-between">
        <div class="flex justify-normal gap-2 sm:gap-4">
            <button class="btn btn-square btn-sm btn-ghost" wire:click="changeMonth(-1)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>
            <p class="font-semibold text-xl w-48">
                {{ $firstDayOfMonth->isoFormat('MMMM YYYY') }}
            </p>
            <button class="btn  btn-sm btn-ghost normal-case" wire:click="changeMonth(0)">
                {{ __('Current Month') }}
            </button>
            <button class="btn btn-square btn-sm btn-ghost" wire:click="changeMonth(1)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>
    <div class="my-4 divider"></div>
    <div class="grid grid-cols-7 gap-6 sm:gap-12 place-items-center">
        @foreach($daysOfTheWeekShort as $day)
            <div class="text-xs capitalize">
                {{ __("localizations.$day") }}
            </div>
        @endforeach
    </div>


    <div class="grid grid-cols-7 mt-1  place-items-center">
        @foreach ($this->allDaysInMonth() as $day)
            <div class="{{ $this->colStartClasses[$day->dayOfWeekIso] }}border border-solid w-full h-28">
                <p class="flex items-center justify-center h-8 w-8 rounded-full mx-1 mt-1 text-sm cursor-pointer hover:bg-base-300{{ $day->isToday() ? ' bg-blue-100 dark:bg-blue-400 dark:hover:bg-base-300 dark:text-white' : '' }}{{ !$day->isSameMonth($this->firstDayOfMonth) ? ' text-slate-400 dark:text-slate-600' : ''}}"
                    wire:click="addNewEvent(day)">
                    {{ $day->day }}
                </p>
                @foreach ($this->transactions as $transaction)
                    @if ($transaction->registered_at->isSameDay($day))
                        <p wire:click="openTransactionDetail($transaction->ulid)" class="text-xs px-2 mt-1 truncate">
                            {{ $transaction->name }}
                        </p>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</div>
