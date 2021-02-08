<x-layout :title="$article->title" :description="$article->description">
    <article class="max-w-full">

        @if($article->updated_at < today()->subYear())
            <p class="text-center md:text-left border border-yellow-300 p-4 rounded mb-4">
                This article was updated over a year ago, so please be aware that some content may be out of date.
            </p>
        @endif

        <div class="mb-4">
            <span class="uppercase tracking-widest text-sm">
               {{ $article->updated_at->isoFormat('LLLL') }}
            </span>

            @if($article->tags->count())
                <i class="bi-dot"></i>

                <ul class="inline-flex space-x-2">
                    @foreach($article->tags as $tag)
                        <li class="uppercase text-sm tracking-widest">
                            <a href="{{ route('tags.show', $tag) }}">
                                {{ $tag->name }}
                            </a>
                            @if(!$loop->last)
                                <i class="bi-dot"></i>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="mb-2 sm:mb-8">
            <h1 class="text-3xl mt-2 md:text-6xl leading-tight tracking-wide font-bold text-black">
                {{ $article->title }}
            </h1>
            <p class="my-4 md:text-xl">
                {!! $article->description !!}
            </p>
        </div>

        <x-articles.image :article="$article" iconSize="10em" class="h-96 rounded-lg" />

        <div class="prose lg:prose-xl mt-8 xl:mt-16 mx-auto mb-8 lg:mb-16">
            {!! Str::of($article->body)->markdown() !!}
        </div>

        <div class="bg-gray-50 p-4 md:p-12 xl:p-16 text-center rounded-lg">
            <div class="text-2xl mb-4">
                Thank you for reading this article.
            </div>
            <div>
                I hope you learned something useful.
            </div>
            <div>
                If you've made it this far, you might like to follow me on Twitter
                where I post similar content and connect with like-minded people.
            </div>
            <a class="bg-gray-600 hover:bg-orange-600 text-white shadow-sm px-4 py-2 rounded-lg mt-8 inline-flex items-center justify-center space-x-2 transition-colors duration-300 ease-in-out"
               href="https://www.twitter.com">
                <i class="bi-twitter"></i>
                <span>Follow me on Twitter</span>
            </a>
        </div>

        <x-articles.list-two-up class="mt-8 lg:mb-16" :articles="$similarArticles" />

        <div class="flex justify-center my-8 lg:my-16">
            <a class="px-4 py-2 border rounded-lg hover:border-orange-600 transition-colors duration-300 ease-in-out"
               href="{{ route('articles.index') }}">
                See more articles
            </a>
        </div>

        @push('scripts')
            <script type="application/javascript"
                    src="https://utteranc.es/client.js"
                    repo="carlcassar/blog-comments"
                    issue-term="pathname"
                    theme="github-light"
                    crossorigin="anonymous"
                    async>
            </script>

            <script id="twitter-wjs"
                    type="text/javascript"
                    async
                    defer
                    src="https://platform.twitter.com/widgets.js"></script>
        @endpush

    </article>
</x-layout>
