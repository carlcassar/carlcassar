<x-app-layout title='Articles'>

    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
{{--            @if($tag)--}}
{{--                <span class="text-sm uppercase text-gray-600 dark:text-gray-500">--}}
{{--                with the tag--}}
{{--                <span class="text-black dark:text-gray-300">{{ $tag }}</span>--}}
{{--            </span>--}}
{{--            @endif--}}
{{--            @if($year)--}}
{{--                <span class="text-sm uppercase text-gray-600 dark:text-gray-500">--}}
{{--                in the year--}}
{{--                <span class="text-black dark:text-gray-300">{{ $year }}</span>--}}
{{--            </span>--}}
{{--            @endif--}}
        </h1>
    </x-slot>

    <x-slot name="aside">
        <x-recents/>
        <x-tags/>
        <x-years/>
    </x-slot>

    <x-article-list :articles="$articles" />
</x-app-layout>
