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
            <span class="text-sm uppercase">{{ $tag }}</span>
            <span class="text-sm uppercase">{{ $year }} </span>
        </h1>
    </x-slot>

    <livewire:article-list class="mt-4" />
</x-app-layout>
