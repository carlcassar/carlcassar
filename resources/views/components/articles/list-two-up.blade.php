<div {{ $attributes->merge(['class' => 'grid gap-8 md:gap-8' . ($articles->count() > 1 ? ' lg:grid-cols-2' : '') ]) }}>
    @foreach($articles as $article)
        <div>
            <x-articles.image :article="$article" class="h-64 rounded-lg" />
            <div class="px-4">
                <a href="{{ route('articles.show', $article) }}"
                   class="block text-2xl pb-2 md:text-3xl tracking-wide font-bold text-black mt-2 md:mt-4">
                    {{ $article->title }}
                </a>
                <div class="prose max-w-full">
                    {!! Str::of($article->description)->markdown() !!}
                </div>
                <a href="{{ route('articles.show', $article) }}" class="block mt-2 link">
                    Read this article
                    <svg class="h-5 w-5 inline-block"
                         xmlns="http://www.w3.org/2000/svg"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
</div>
