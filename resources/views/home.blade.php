<x-app-layout>
    <div class="border-b-2 border-dashed border-gray-200 py-4 pb-8">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white font-serif text-justify">
            Hello 👋
        </h1>

        <p class="mt-4 text-gray-500 dark:text-gray-400 leading-relaxed">
            I'm @carlcassar on
            <a class="underline text-orange-500" href="https://x.xom/carlcassar">X</a>,
            <a class="underline text-orange-500" href="https://instagram.xom/carlcassar">Instagram</a> and
            <a class="underline text-orange-500" href="https://github.xom/carlcassar">Github</a>.
            I make websites and apps. Stick around if you're interested in PHP, Laravel, Javascript, Aws and a whole
            host of other interesting topics.
        </p>
    </div>

    <x-article-list class="mt-4" :articles="$articles" />
</x-app-layout>
