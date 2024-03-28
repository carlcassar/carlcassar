@php
    $year = request('year')
@endphp

<x-app-layout title="Articles - {{$year}}">

    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200">
            <span>{{ __('Articles') }}</span>
            <span class="text-sm uppercase text-gray-600 dark:text-gray-500">in the year</span>
            <span>{{ $year }}</span>
        </h1>
    </x-slot>

    <x-article-list :year="$year" :articles="$articles" />

    <x-slot name="aside">
        <x-recents />
        <x-tags />
        <x-years />
    </x-slot>

</x-app-layout>
