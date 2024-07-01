<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

?>

<nav x-data="{ notificationsOpen: false, notificationsCount: 0 }" class="navbar sticky top-0 bg-base-100 z-10 shadow-md">
    <!-- Menu toogle for mobile view or small screen -->
    <div class="flex-1">
        <label for="left-sidebar-drawer" class="btn btn-primary drawer-button lg:hidden">
        <Bars3Icon class="h-5 inline-block w-5"/></label>
        <h1 class="text-2xl font-semibold ml-2">{{ $pageTitle ?? '' }}</h1>
    </div>

    <div class="flex-none">
        <!-- Notification icon -->
        <button class="btn btn-ghost ml-4 btn-circle" @click="notificationsOpen = !notificationsOpen">
            <div class="indicator">
                 <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
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
