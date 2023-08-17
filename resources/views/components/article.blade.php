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

    <div
        class="pt-6 prose max-w-none dark:prose-invert font-body text-base leading-normal tracking-wide text-black dark:text-white prose-headings:font-sans prose-headings:leading-tight prose-headings:font-extrabold">
        {!! $article->content !!}
    </div>

    <x-card class="mt-10 p-4 border dark:text-gray-900">
        <h2 class="text-lg font-bold pb-2">Thank you for reading this article.</h2>
        If you've made it this far, you might like to
        <x-link class="font-bold" href="https://www.x.com/carlcassar">connect with me on 𝕏</x-link>
        where I post similar content and interact with like-minded people. If this article was helpful to you I'd really
        appreciate it if you would consider buying me a coffee.

        <div class="mt-4">
            <x-link type="button" href="https://buy.stripe.com/5kA4hXfElbjgaaY000">
                <span class="pr-2">☕️</span>Leave a small tip
            </x-link>
        </div>
    </x-card>

    {{ $slot }}

    <x-slot name="aside">
        <x-table-of-contents :article="$article"/>
    </x-slot>
</div>