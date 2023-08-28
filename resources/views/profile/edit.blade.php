<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="space-y-4">
        <x-card class="p-8">
            @include('profile.partials.update-profile-information-form')
        </x-card>

        <x-card class="p-8">
            @include('profile.partials.update-password-form')
        </x-card>

        <x-card class="p-8">
            @include('profile.partials.delete-user-form')
        </x-card>
    </div>
</x-app-layout>
