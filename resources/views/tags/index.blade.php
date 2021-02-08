<x-layout title="Tags">
    <x-title title="Tags" />

    @if($tags->count())
        <x-tag-cloud :tags="$tags" />
    @else
        <div class="text-center">
            No tags were found.
        </div>
    @endif
</x-layout>
