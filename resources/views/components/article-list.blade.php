@props([
    'articles'
])

<div {{ $attributes }}>
    @foreach($articles as $article)
        <div class="pb-10">
            <div class="max-h-96 relative overflow-hidden">
                <h2 class="text-5xl font-extrabold font-serif dark:invert">{{ Str::title($article->title) }}</h2>
                <div class="pt-2 dark:invert">{{ $article->created_at->diffForHumans() }}</div>
                <div class="prose dark:prose-invert max-w-none mt-4">
                    {!! $article->content !!}
                </div>
                <div
                    class="h-24 absolute bottom-0 w-full dark:text-white bg-gradient-to-b from-transparent to-gray-100 dark:to-gray-900">
                </div>
            </div>
            <a href="{{ route('articles.show', $article) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Continue Reading
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="ml-2 w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>
    @endforeach
</div>