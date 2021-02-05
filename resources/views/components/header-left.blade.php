<div {{ $attributes }}>
    <a class="ml-4 nav-link {{ Route::currentRouteName() === 'articles' ? 'text-orange-600' : '' }}"
       href="{{ route('articles') }}">
        Articles
    </a>
{{--    <a class="ml-4 nav-link"--}}
{{--       href="/tags"--}}
{{--       exact-active-class="text-orange-600">--}}
{{--        Tags--}}
{{--    </a>--}}
{{--    <a class="ml-4 nav-link"--}}
{{--       href="/rss"--}}
{{--       exact-active-class="text-orange-600">--}}
{{--        RSS--}}
{{--    </a>--}}
</div>
