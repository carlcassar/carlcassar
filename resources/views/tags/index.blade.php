<x-app-layout title="Tags">
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h1>
    </x-slot>

    <div class="grid grid-cols-8 gap-2">
        @foreach($tags as $tag)
            <x-tag-link :tag="$tag"/>
        @endforeach
    </div>

</x-app-layout>
