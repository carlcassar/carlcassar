@props(['title'])

<x-app-layout :title="'Settings / '. $title">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings / ' . $title) }}
        </h2>
    </x-slot>

    <x-slot name="before">
        @include('settings.partials.settings-navigation')
    </x-slot>

    <x-slot name="aside">
        @include('settings.partials.settings-navigation')
    </x-slot>

    <div>
        {{ $slot }}
    </div>
</x-app-layout>
