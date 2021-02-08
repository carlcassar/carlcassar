<x-layout title="Home">
    <x-banner />

    @if($featured)
        <x-articles.featured :article="$featured" />
    @endif

    @if($articles->count())
        <x-articles.list-two-up :articles="$articles" />
    @endif
</x-layout>
