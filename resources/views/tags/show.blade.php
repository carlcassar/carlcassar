<x-layout>
    <x-title title="{{ $tag->name }}" />

    <x-tag-cloud :tags="$tags" :currentTag="$tag" />

    <x-articles.list :articles="$tag->articles" />
</x-layout>
