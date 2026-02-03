<x-app-layout title="A Full-Stack Software Development Blog">
    <x-slot name="hero">
        <h1 class="md:w-2/3 m-auto text-center md:pt-16 md:pb-20">
            <p class="text-3xl md:text-5xl font-bold text-gray-900 dark:text-white">
                Hello 👋
            </p>

            <p class="mt-4 text-lg md:text-2xl text-gray-500 dark:text-gray-400 leading-relaxed">
                I'm <span class="text-black dark:text-white">Carl</span>. You can find me on
                <x-link href="https://github.com/carlcassar" target="_blank" rel="noopener noreferrer">Github</x-link>
                and
                <x-link href="https://bsky.app/profile/carlcassar.com" target="_blank" rel="noopener noreferrer">Bluesky</x-link>
                .
                I've been making websites and apps
                <x-link :href="route('articles.show','evolution-of-my-blog-a-wayback-machine-retrospective')">
                    for well over ten years
                </x-link>.
                This is my blog, where I write about
                <x-link :href="route('tags.show', 'php')">PHP</x-link>,
                <x-link :href="route('tags.show', 'laravel')">Laravel</x-link>,
                <x-link :href="route('tags.show', 'javascript')">Javascript</x-link>,
                <x-link :href="route('tags.show', 'aws')">AWS</x-link>,
                and other
                <x-link :href="route('tags.index')">interesting topics</x-link>.
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
