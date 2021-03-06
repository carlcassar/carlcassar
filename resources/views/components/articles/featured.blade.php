<div class="mb-8 lg:mb-14 w-full">
    <x-articles.image :article="$article" iconSize="10em" class="h-64 rounded-lg" />
    <div class="lg::flex lg:justify-center md:text-center md:p-4 px-4 md:px-0">
        <a class="block text-2xl mb-4 md:text-3xl tracking-wide font-bold text-black mt-4"
           class="block"
           href="{{ route('articles.show', $article) }}">
            {{ $article->title }}
        </a>
        <div class="prose max-w-full">
            {!! Str::of($article->description)->markdown() !!}
        </div>
        <a class="block mt-4 link" href="{{ route('articles.show', $article) }}">
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
