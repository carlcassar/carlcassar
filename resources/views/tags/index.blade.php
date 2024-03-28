<x-app-layout title="Tags">
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h1>
    </x-slot>

    <div class="grid grid-cols-4 gap-2">
        @foreach($tags as $tag)
            <x-tag-link class="py-5" :tag="$tag"/>
        @endforeach
    </div>

    <x-slot name="aside">
        <x-recents/>
        <x-years/>
    </x-slot>

</x-app-layout>
