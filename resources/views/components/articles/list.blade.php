@foreach($articles as $article)
    <div class="items-center mt-2 mb-8 lg:flex lg:space-x-8 lg:mt-4">
        <x-articles.image :article="$article" class="w-full h-52 rounded-lg lg:w-2/5 xl:w-1/4" />

        <div class="px-4 mt-4 w-full lg:w-3/5 xl:w-3/4 lg:px-0 lg:mt-0">
            <a href="{{ route('articles.show', $article) }}">
                <div class="pb-2 text-2xl font-bold tracking-wide text-black md:text-3xl md:leading-none">
                    {{ $article->title }}
                </div>

                <div class="flex flex-wrap my-2 -ml-2 space-x-2 text-sm tracking-widest uppercase">
                    @foreach($article->tags as $tag)
                        <a class="hover:text-orange-600" href="{{ route('tags.show', $tag) }}">
                            {{ $tag->name }}
                            @if(!$loop->last)
                                <i class="bi-dot"></i>
                            @endif
                        </a>
                    @endforeach
                </div>

                <div class="pb-2 max-w-full prose">
                    {!! Str::of($article->description)->markdown() !!}
                </div>

                <a class="mt-4 link" href="{{ route('articles.show', $article) }}">
                    Read this article
                    <svg class="inline-block w-5 h-5"
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
