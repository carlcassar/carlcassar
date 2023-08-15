<x-app-layout>
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h1>
    </x-slot>

    <x-article-list :articles="$articles"/>
</x-app-layout>
