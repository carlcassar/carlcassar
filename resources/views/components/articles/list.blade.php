@foreach($articles as $article)

    <div class="lg:flex items-center mb-8">
            <x-articles.image :article="$article" class="h-64 rounded-lg w-full lg:w-1/4 mr-8 mb-4 " />

        <div class="w-full lg:w-3/4">
            <a href="{{ route('articles.show', $article) }}">
                <div class="text-2xl pb-2 md:text-3xl md:leading-none tracking-wide font-thin text-black">
                    {{ $article->title }}
                </div>

                <div class="flex flex-wrap space-x-2 uppercase text-sm font-thin -ml-2 my-2">
                    @foreach($article->tags as $tag)
                        <a class="text-gray-700 hover:text-orange-600" href="{{ route('tags.show', $tag) }}">
                            {{ $tag->name }}
                        </a>
                    @endforeach
                </div>

                <p class="pb-2">
                    {{ $article->description }}
                </p>
                <a class="mt-4 link" href="{{ route('articles.show', $article) }}">
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
            </a>
        </div>
    </div>
@endforeach
