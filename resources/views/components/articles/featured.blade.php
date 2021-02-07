<div class="mb-8 lg:mb-14 w-full">
    <x-articles.image :article="$article" iconSize="10em" class="h-96 rounded-t-lg" />
    <div class="rounded-b-lg lg::flex lg:justify-center md:text-center p-4 pb-8 lg:py-10 lg:pb-14 border">
        <a class="block text-2xl mb-4 md:text-3xl tracking-wide font-bold text-black mt-4"
           class="block"
           href="{{ route('article.show', $article) }}">
            {{ $article->title }}
        </a>
        <div>
            {{ $article->description }}
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
