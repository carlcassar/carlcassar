<x-app-layout
    :title="$article->title"
    :description="$article->description"
    :keywords="$article->tags"
    :published_at="$article->published_at?->toIso8601String()"
>
    {{$article->tags}}

    <x-article :article="$article" />
</x-app-layout>
