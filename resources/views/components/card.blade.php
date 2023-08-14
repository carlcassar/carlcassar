    <div {{ $attributes->merge(['class' => 'overflow-hidden sm:border dark:border-gray-800 sm:rounded-xl']) }}>
        @if(isset($title))
        <div class="pb-2 text-sm font-semibold uppercase text-gray-800 dark:text-white">
            {{ $title }}
        </div>
        @endif
        {{ $slot }}
    </div>
