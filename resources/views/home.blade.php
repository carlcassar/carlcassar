<x-app-layout title="A Full-Stack Software Development Blog">
    <x-slot name="hero">
        <h1 class="md:w-2/3 m-auto text-center md:pt-16 md:pb-20">
            <p class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white">
                Hello 👋
            </p>

            <p class="mt-4 text-lg md:text-2xl text-gray-500 dark:text-gray-400 leading-relaxed">
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
    </x-slot>

    <x-slot name="aside">
        <x-recents />
        <x-tags />
        <x-years />
    </x-slot>

    <x-article-list :articles="$articles" class="mt-4" />
</x-app-layout>
