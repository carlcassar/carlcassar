<x-layout>
    <article class="max-w-full">

        @if($article->updated_at < today()->subYear())
            <p class="text-center md:text-left border border-yellow-300 p-4 rounded mb-4">
                This article was updated over a year ago, so please be aware that some content may be out of date.
            </p>
        @endif

        <div>
            <span class="uppercase tracking-widest text-sm text-gray-800 font-light">
               {{ $article->updated_at->isoFormat('LLLL') }}
            </span>

            <span class="px-2">&vert;</span>

            <ul class="inline-flex space-x-2">
                @foreach($article->tags as $tag)
                    <li class="uppercase text-sm text-gray-500">
                        <a href="{{ route('tags.show', $tag) }}">
                            {{ $tag->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
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

        <div class="prose lg:prose-xl mt-8 xl:mt-16 mx-auto">
            {!! Str::of($article->body)->markdown() !!}
        </div>

        <div class="flex justify-center my-8 lg:my-16">
            <div>
                <a class="px-4 py-2 border rounded-lg" href="{{ route('articles.index') }}">
                    See more articles
                </a>
            </div>
        </div>

        <div class="flex justify-center text-center py-4 md:text-xl leading-normal tracking-wide font-thin">
            <div class="px-4 md:px-16 xl:px-32">
                Thank you for reading this article. I hope you learned something useful.
                If you've made it this far, you might like to follow me on
                <ExternalLink :to="config.links.twitter" text="Twitter" />
                where I post similar content and connect with like-minded people.
            </div>
        </div>


    </article>
</x-layout>
