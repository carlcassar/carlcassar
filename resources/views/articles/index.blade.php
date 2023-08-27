@php
    $tag = Str::ucfirst(request()->query('tag'));
    $year = Str::ucfirst(request()->query('year'));

    $title = 'Articles';

    if($tag) {
        $title .= ' - '.$tag;
    }

    if($year) {
        $title .= ' - '.$year;
    }
@endphp

<x-app-layout title="{{$title}}">
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
            @if($tag)
                <span class="text-sm uppercase text-gray-600">
                with the tag
                <span class="text-black">{{ $tag }}</span>
            </span>
            @endif
            @if($year)
                <span class="text-sm uppercase text-gray-600">
                in the year
                <span class="text-black">{{ $year }}</span>
            </span>
            @endif
        </h1>
    </x-slot>

    <livewire:article-list class="mt-4"/>
</x-app-layout>
