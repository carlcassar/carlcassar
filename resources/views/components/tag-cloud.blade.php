<div class="flex justify-center flex-wrap space-x-2 mb-10">
    @foreach ($tags as $tag)
        <a href="{{ route('tags.show', $tag) }}"
           class="flex items-center space-x-2 px-4 py-1 border hover:border-orange-600 transition-color duration-200 rounded-lg cursor-pointer mb-2 {{ isset($currentTag) && $currentTag->name === $tag->name ? 'border-orange-600' : '' }}"
        >
            <i class="bi-circle" style="color: {{ $tag->colour }}; font-size:.5em"></i>
            <span>{{ Str::title($tag->name) }}</span>
        </a>
    @endforeach
</div>
