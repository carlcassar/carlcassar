@props([
    'article'
])

<div {{ $attributes }} >
    <h1 class="dark:invert text-5xl font-extrabold leading-tight">
        {{ Str::title($article->title) }}
    </h1>

    <div class="dark:invert mt-6">
        {{ $article->published_at->diffForHumans() }}
        <span class="border-l border-gray-400 dark:border-gray-700 mx-2"></span>
        {{ $article->published_at->toFormattedDayDateString() }}
    </div>

    @if($article->tags)
        <div class="flex mt-4 flex-wrap space-x-2">
            @foreach(Str::of($article->tags)->explode(',') as $tag)
                <div
                    class="capitalize px-3 py-1 text-xs tracking-wide rounded-md border border-black dark:border-gray-800 text-gray-800 dark:text-gray-200">
                    {{ $tag }}
                </div>
            @endforeach
        </div>
    @endif

    <div class="pt-6 prose max-w-none dark:prose-invert font-body text-base leading-normal tracking-wide text-black dark:text-white prose-headings:font-sans prose-headings:leading-tight prose-headings:font-extrabold">
        {!! $article->content !!}
    </div>

    {{ $slot }}
</div>
