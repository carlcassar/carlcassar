<x-app-layout>
    <div class="border-b-2 border-dashed border-gray-200 py-4 pb-8 mb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white font-serif text-justify">
            Hello 👋
        </h1>

        <p class="mt-4 text-gray-500 dark:text-gray-400 leading-relaxed">
            I'm @carlcassar on
            <x-link href="https://x.com/carlcassar">X</x-link>,
            <x-link href="https://instagram.com/carlcassar">Instagram</x-link> and
            <x-link href="https://github.com/carlcassar">Github</x-link>.
            I make websites and apps. Stick around if you're interested in PHP, Laravel, Javascript, Aws and a whole
            host of other interesting topics.
        </p>
    </div>

    <livewire:article-list class="mt-4" />
</x-app-layout>
