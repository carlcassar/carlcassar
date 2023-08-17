@props([
    'href' => '#',
    'title' => ''
])

<div>
    <a class="capitalize text-black dark:text-gray-400 hover:text-orange-500 underline transition-colors duration:200"
       href="{{ $href }}">{{ $title }}</a>
</div>
