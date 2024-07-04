<?php

use App\Livewire\Actions\Logout;
use function Livewire\Volt\{state};

state(['header' => '']);

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav x-data="{ notificationsOpen: false, notificationsCount: 0 }"
    class="navbar sticky top-0 bg-base-100 z-10 shadow-md">
    <!-- Menu toogle for mobile view or small screen -->
    <div class="flex-1">
        <label for="left-sidebar-drawer" class="btn btn-primary drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </label>
        <h1 class="text-2xl font-semibold ml-2">{!! $header !!}</h1>
    </div>

    <div class="flex-none">
        <!-- Notification icon -->
        <button class="btn btn-ghost ml-4 btn-circle" @click="notificationsOpen = !notificationsOpen">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
                <template x-if="notificationsCount > 0">
                    <span x-text="notificationsCount" class="indicator-item badge badge-secondary badge-sm"></span>
                </template>
            </div>
        </button>

        <!-- Profile icon, opening menu on click -->
        <div class="dropdown dropdown-end ml-4">
            <label tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img alt="User profile picture" src="{{ auth()->user()->avatar ?? '' }}" />
                </div>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li class="items-center">
                    <!-- Light and dark theme selection toogle -->
                    <x-theme-toggle></x-theme-toggle>
                </li>
                <div class="divider mt-0 mb-0"></div>
                <li>
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                </li>
                <div class="divider mt-0 mb-0"></div>
                <li>
                    <!-- Authentication -->
                    <x-responsive-nav-link wire:click="logout">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
