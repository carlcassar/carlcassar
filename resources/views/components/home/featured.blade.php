<div class="lg:w-1/2 mb-8 {{ $odd ? 'lg:pl-4' : 'lg:pr-4' }}">
    <x-articles.image :article="$article" class="h-64 rounded-lg" />
    <div class="md:px-4">
        <a href="{{ route('article.show', $article) }}"
           class="block text-2xl pb-2 md:text-3xl tracking-wide font-bold text-black mt-4">
            {{ $article->title }}
        </a>
        <div>
            {{ $article->description }}
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
