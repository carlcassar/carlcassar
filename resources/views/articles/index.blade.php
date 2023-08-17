<x-app-layout>
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
            <span class="text-sm uppercase">{{ request()->query('tag')}} </span>
            <span class="text-sm uppercase">{{ request()->query('year')}} </span>
        </h1>
    </x-slot>

    <livewire:article-list class="mt-4" />
</x-app-layout>
