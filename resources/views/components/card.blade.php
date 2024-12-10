@props(['title' => '', 'topSideButtons' => ''])

<div class="card w-full p-6 bg-base-100 shadow-xl">
    <div class="text-xl font-semibold {{ $topSideButtons ? 'inline-block' : '' }}">
        {{ $title }}
        @if($topSideButtons)
            <div class="inline-block float-right">
                {{ $topSideButtons }}
            </div>
        @endif
    </div>

    <div class="divider mt-2"></div>

    <div class='h-full w-full pb-6 bg-base-100'>
        {{ $slot }}
    </div>
</div>
