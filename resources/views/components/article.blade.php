@props([
    'article',
    'list' => false
])

<div {{ $attributes }} >
    @if($list)
        <a href="{{ route('articles.show', $article) }}">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">
                {{ Str::title($article->title) }}
            </h2>
        </a>

        @if($article->tags)
            <div class="flex mt-4 mb-3 flex-wrap space-x-2">
                @foreach($article->tags as $tag)
                    <x-tag-link :tag="$tag" />
                @endforeach
            </div>
        @endif
    @else
        <x-slot name="hero">
            <div class="md:py-10 mx-auto">
                <div class="dark:invert ml-1 mb-2 lg:text-center text-gray-600">
                    {{ $article->published_at?->diffForHumans() }}
                    <span class="border-l border-gray-400 dark:border-gray-700 mx-2"></span>
                    {{ $article->published_at?->toFormattedDayDateString() }}
                </div>

                <h1 class="dark:invert text-3xl md:text-5xl font-extrabold leading-tight lg:text-center">
                    {{ Str::title($article->title) }}
                </h1>

                    @if($article->tags)
                        <div class="flex mt-4 flex-wrap space-x-2 lg:justify-center">
                            @foreach($article->tags as $tag)
                                <x-tag-link :tag="$tag" />
                            @endforeach
                        </div>
                    @endif
            </div>
        </x-slot>
    @endif

    <div
        class="prose prose-orange max-w-none dark:prose-invert font-body md:text-base leading-normal tracking-wide text-black dark:text-white prose-headings:font-sans prose-headings:leading-tight prose-headings:font-extrabold">
        {!! $list ? $article->previewContent() : $article->content !!}
    </div>

    <x-card class="mt-10 p-4 border dark:text-gray-900">
        <h2 class="text-lg font-bold pb-2">Thank you for reading this article.</h2>
        If you've made it this far, you might like to
        <x-link class="font-bold" href="https://www.x.com/carlcassar">connect with me on 𝕏</x-link>
        where I post similar content and interact with like-minded people. If this article was helpful to you I'd really
        appreciate it if you would consider buying me a coffee.

        <div class="md:flex md:space-x-4 items-center mt-4">
            <div>
                <x-link type="button" href="https://buy.stripe.com/5kA4hXfElbjgaaY000">
                    <span class="pr-2">☕️</span>Leave a small tip
                </x-link>
            </div>

            <div>
                or
            </div>

            <div class="md:mt-0">
                <x-link type="button" href="https://github.com/sponsors/carlcassar">
                    <span class="pr-2">Sponsor me on GitHub</span>
                </x-link>
            </div>
        </div>
    </x-card>

    {{ $slot }}
</div>
