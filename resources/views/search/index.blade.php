<x-layout :title="'Search' . (request()->get('query') ? ' - ' . request()->get('query') : '')">
    <x-title title="Search">
        <form method="get">
            <div class="flex">
                <input name="query"
                       value="{{ request()->get('query') }}"
                       class="rounded-lg rounded-r-none border flex-grow px-4 py-2 outline-none"
                       type="text"
                       placeholder="Search for an articles..." />
                <button class="w-10 border rounded-r-lg border-l-0 hover:bg-gray-100 transition-colors duration-300 ease-in-out">
                    <i class="bi-arrow-right"></i>
                </button>
            </div>
        </form>
    </x-title>

    @if($articles->count())
        <x-articles.list :articles="$articles" />
    @elseif(request()->get('query'))
        <div class="text-center">
            No articles were found that match your search query.
        </div>
    @endif

    {{ $articles->links() }}
</x-layout>
