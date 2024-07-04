<?php
?>
<div x-data class="drawer-side z-30">
    <label for="left-sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu pt-2 w-80 bg-base-100 min-h-full text-base-content">
        <button class="btn btn-ghost bg-base-300 btn-circle z-50 top-0 right-0 mt-4 mr-2 absolute lg:hidden"
                @click="$dispatch('close-sidebar')">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
            </svg>
        </button>

        <li class="mb-2 font-semibold text-xl">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <img class="mask mask-squircle w-10" src="" alt="Money Logo"/>Money
            </a>
        </li>
    </ul>
</div>
