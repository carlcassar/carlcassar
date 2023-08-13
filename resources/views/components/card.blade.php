    <div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 overflow-hidden sm:border dark:border-gray-900 sm:rounded-xl']) }}>
        @if(isset($title))
        <div class="pb-2 text-sm font-semibold uppercase text-gray-800 dark:text-white">
            {{ $title }}
        </div>
        @endif
        {{ $slot }}
    </div>
