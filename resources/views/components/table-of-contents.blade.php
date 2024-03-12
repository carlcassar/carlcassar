@props(['article'])

@if(isset($article) && $article->table_of_contents && request()->routeIs('articles.show'))
    <x-card class="p-4">
        <x-slot name="title">
            Table Of Contents
        </x-slot>

        <div class="prose dark:prose-a:text-gray-400 prose-li:my-0">
            <ul class="list-disc">
                {!! $article->table_of_contents !!}
            </ul>
        </div>
    </x-card>
@endif
