<?php
?>
<div x-data="{ open: false }" class="drawer-side z-30">
    <label for="left-sidebar-drawer" class="drawer-overlay"></label>
    <ul class="menu pt-2 w-80 bg-base-100 min-h-full text-base-content">
        <button class="btn btn-ghost bg-base-300  btn-circle z-50 top-0 right-0 mt-4 mr-2 absolute lg:hidden" @click="open = !open">
            <span class="h-5 inline-block w-5">X</span>
        </button>

        <li class="mb-2 font-semibold text-xl">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <img class="mask mask-squircle w-10" src="" alt="Money Logo"/>Money
            </a>
        </li>
    </ul>
</div>
