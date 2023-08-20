<x-app-layout>
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h1>
    </x-slot>

    <x-card class="p-4">
        <p>
            There's not much to see inside here yet, but I'll be adding more features over the next few hours, days and
            weeks. Stay tuned.
        </p>

        <p class="mt-2">
            For now, you can
            <x-link :href="route('articles.index')">check out my existing articles</x-link>
            .
        </p>
    </x-card>
</x-app-layout>
