@props([
    'tag'
])

<a href="{{route('articles.index', ['tag' => $tag]) }}"
   class="text-center capitalize px-2 py-0.5 text-sm tracking-wide rounded-md border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:border-orange-600 transition-colors duration-200">
    {{ $tag }}
</a>