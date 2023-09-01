<x-app-layout
    :title="$article->title"
    :description="$article->description"
    :keywords="$article->tags"
    :published_at="$article->published_at?->toDateString()"
>

    <x-slot name="aside">
        <x-table-of-contents :article="$article"/>
        <x-tags/>
        <x-years/>
    </x-slot>

    <x-article :article="$article"/>
</x-app-layout>
