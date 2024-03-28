@php
    $tag = Str::of(request('tag'))->title()
@endphp

<x-app-layout title="Articles - {{$tag}}">

    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200">
            <span>{{ __('Articles') }}</span>
            <span class="text-sm uppercase text-gray-600 dark:text-gray-500">tagged</span>
            <span>{{ $tag }}</span>
        </h1>
    </x-slot>

    <x-article-list :articles="$articles" />

    <x-slot name="aside">
        <x-recents />
        <x-tags />
        <x-years />
    </x-slot>

</x-app-layout>
