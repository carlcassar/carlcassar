<x-app-layout
    :title="$article->title"
    :description="$article->description"
    :keywords="$article->tags->join(', ')"
    :publishedAt="$article->published_at?->toDateTimeString()"
    :updatedAt="$article->updated_at?->toDateTimeString()"
>
    <x-slot name="aside">
        <x-table-of-contents :article="$article"/>
        <x-tags/>
        <x-years/>
    </x-slot>

    <x-article :article="$article"/>
</x-app-layout>
