<x-layout>
    <x-title title="Articles" />

    <x-articles.list :articles="$articles" />

    {{ $articles->links() }}
</x-layout>
