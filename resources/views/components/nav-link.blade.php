@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-4 py-2 rounded-lg hover:bg-gray-200 hover:dark:bg-gray-800 bg-gray-50 dark:bg-gray-950 text-gray-800 hover:text-orange-700 dark:text-gray-100 transition duration-200'
            : 'px-4 py-2 rounded-lg hover:bg-gray-200 hover:dark:bg-gray-800 text-gray-500 hover:text-orange-700 dark:text-gray-100 transition duration-200';
@endphp

<a class="uppercase cursor-default inline-flex items-center px-1 pt-1 text-sm tracking-widest font-semibold leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
    <div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    </div>
</a>
