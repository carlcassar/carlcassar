<x-layout title="Home">
    <x-banner />

    <x-articles.featured :article="$featured" />

    <x-articles.list-two-up :articles="$articles" />
</x-layout>
