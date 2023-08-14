<x-app-layout>
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

    <div class="pt-6 prose max-w-none dark:prose-invert">
        {!! $article->content !!}
    </div>
</x-app-layout>
