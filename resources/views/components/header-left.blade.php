<div {{ $attributes }}>
    <a class="ml-4 nav-link {{ Route::currentRouteName() === 'articles.index' ? 'text-orange-600' : '' }}"
       href="{{ route('articles.index') }}">
        Articles
    </a>

    <a class="ml-4 nav-link {{ (strpos(Route::currentRouteName(), 'tags') === 0) ? 'text-orange-600' : '' }}"
       href="{{ route('tags.index') }}">
        Tags
    </a>
{{--    <a class="ml-4 nav-link"--}}
{{--       href="/rss"--}}
{{--       exact-active-class="text-orange-600">--}}
{{--        RSS--}}
{{--    </a>--}}
</div>
