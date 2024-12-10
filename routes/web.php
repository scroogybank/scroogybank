<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountGroupController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::redirect('/', 'dashboard');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resources([
        'accounts' => AccountController::class,
        'account_groups' => AccountGroupController::class,
        'stores' => StoreController::class,
        'transactions' => TransactionController::class,
    ]);
    Volt::route('categories', 'pages.categories.list')
        ->name('categories.index');
    Volt::route('categories/create', 'pages.categories.show')
        ->name('categories.create');
    Volt::route('categories/{ulid}', 'pages.categories.show')
        ->name('categories.show');
    Volt::route('calendar', 'pages.transactions.calendar')
        ->name('calendar');
    Volt::route('labels', 'pages.labels.list')
        ->name('labels.index');
});
