@props(['article'])

@if(isset($article) && $article->table_of_contents)
    <x-card class="sm:p-4">
        <x-slot name="title">
            Table Of Contents
        </x-slot>

        <div class="prose dark:prose-a:text-gray-400">
            {!! $article->table_of_contents !!}
        </div>
    </x-card>
@endif