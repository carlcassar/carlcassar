    <div {{ $attributes->merge(['class' => 'overflow-hidden bg-zinc-50 dark:bg-gray-800 rounded-md sm:rounded-xl text-black dark:text-white']) }}>
        @if(isset($title))
        <div class="pb-2 text-sm font-semibold uppercase text-gray-800 dark:text-white">
            {{ $title }}
        </div>
        @endif
        {{ $slot }}
    </div>
