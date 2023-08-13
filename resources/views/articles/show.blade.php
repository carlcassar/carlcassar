<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-10 pb-20 space-y-4">
        <h1 class="dark:invert font-serif text-6xl font-bold">{{ Str::title($article->title) }}</h1>
        <div class="dark:invert">{{ $article->created_at->diffForHumans() }}</div>
        @if($article->tags)
            <div class="flex mt-3 flex-wrap space-x-2">
                @foreach(Str::of($article->tags)->explode(',') as $tag)
                    <div
                        class="capitalize px-3 py-1 text-xs tracking-wide rounded-md bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-200">{{ $tag }}</div>
                @endforeach
            </div>
        @endif

        <div class="pt-6 prose dark:prose-invert">
            {!! $article->content !!}
        </div>
    </div>
</x-app-layout>
