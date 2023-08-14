<div class="relative {{ $classes }}">
    <label>
        <input type="search"
               wire:model.live="search"
               class="h-10 rounded w-full border-gray-200 dark:border-gray-800 bg-transparent dark:text-gray-500"
               placeholder="Search Articles..."/>
    </label>

    @if(count($articles))
        <x-card class="absolute mt-2 w-full bg-white dark:bg-gray-800">
            <ul class="divide-y divide-gray-100 dark:divide-gray-900">
                @foreach($articles as $article)
                    <li class="px-4 py-2">
                        <a href="{{ route('articles.show', $article) }}">
                            <div class="font-bold dark:invert">
                                {{ $article->title }}
                            </div>
                            <div class="text-gray-500">
                                {{ Str::title($article->tags) }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </x-card>
    @endif
</div>
