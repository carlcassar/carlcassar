<x-layout>
    <x-title title="Articles" />

    @if($articles->count())
        <x-articles.list :articles="$articles" />

        {{ $articles->links() }}
    @else
        <div class="text-center">
            No articles were found.
        </div>
    @endif
</x-layout>
