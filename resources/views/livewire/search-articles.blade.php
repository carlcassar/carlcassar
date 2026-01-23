<div class="relative z-10 {{ $classes }}">
    <label>
        <input type="search"
               wire:model.live="search"
               class="h-10 rounded w-full bg-zinc-50 dark:bg-gray-800 border-0 bg-opacity-25 focus:outline-none focus:ring focus:ring-orange-500 dark:text-gray-500"
               placeholder="Search Articles..."/>
    </label>

    @if(count($articles))
        <div class="rounded-md absolute mt-2 w-full bg-white dark:bg-gray-800 border dark:border-gray-900 bg-opacity-100">
            <ul class="divide-y divide-gray-100 dark:divide-gray-900">
                @foreach($articles as $article)
                    <li class="px-4 py-2 hover:bg-gray-200 hover:dark:bg-gray-700">
                        <a href="{{ route('articles.show', $article) }}">
                            <div class="font-bold dark:invert">
                                {{ $article->title }}
                            </div>
                            <div class="text-gray-500">
                                {{ Str::title($article->tags->implode(', ')) }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
