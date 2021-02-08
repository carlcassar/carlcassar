<div {{ $attributes->merge(['class' => 'relative w-full text-white font-thin p-4 shadow-lg']) }} style="
    background:
    linear-gradient(135deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 65%, rgba(0, 0, 0, 0) 100%),
    url({{ $article->image }}) center center,
    {{ optional($article->primaryTag)->colour }};
    background-size: cover;
    ">

    @if(!$article->image || (isset($showOverlay) && $showOverlay))
        <div class="absolute bottom-0 right-0 mr-10 -mb-4">
            <i class="bi-{{ $article->icon ?? 'lightbulb-fill' }} opacity-20"
               style="font-size: {{ $iconSize ?? '5em' }}; line-height: 0"></i>
        </div>

        <div class="text-3xl font-bold">
            {{ optional($article->primaryTag)->name }}
        </div>

        <div class="text-2xl">
            {{ $article->title }}
        </div>
    @endif
</div>
