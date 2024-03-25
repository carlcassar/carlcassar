<x-app-layout title="A Full-Stack Software Development Blog">
    <x-slot name="aside">
        <x-recents />
        <x-tags />
        <x-years />
    </x-slot>

    <h1 class="py-4">
        <p class="text-5xl font-bold text-gray-900 dark:text-white text-justify">
            Hello 👋
        </p>

        <p class="mt-4 text-xl text-gray-500 dark:text-gray-400 leading-relaxed">
            I'm @carlcassar on
            <x-link href="https://x.com/carlcassar">X</x-link>
            ,
            <x-link href="https://instagram.com/carlcassar">Instagram</x-link>
            and
            <x-link href="https://github.com/carlcassar">Github</x-link>
            .
            I make websites and apps. Stick around if you're interested in PHP, Laravel, Javascript, AWS and a whole
            host of other interesting topics.
        </p>
    </h1>

    <livewire:article-list class="mt-4" />
</x-app-layout>
