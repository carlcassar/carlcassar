<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="{{ $description ?? "Carl Cassar's blog on Laravel, PHP, JavaScript, DevOps and more." }}">
    <meta name="keywords" content="{{ $keywords ?? "PHP, Laravel, JavaScript, Vue, Nuxt, DevOps, GitHub, Analytics" }}">

    <meta property="og:title" content="Carl Cassar {{ isset($title) ? ' - ' . $title : '' }}" />
    <meta property="og:description"
          content="{{ $description ?? "Carl Cassar's blog on Laravel, PHP, JavaScript, DevOps and more." }}" />
    <meta property="og:url" content="{{ config('app.url') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{ now()->toIso8601String() }}" />
    <meta property="og:image" content="{{ asset($ogImage ?? '/open-graph/logo1200x600.png') }}" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="600" />

    <meta property="theme-color" content="#ffffff" />
    <meta property="msapplication-TileColor" content="#ed8936" />
    <meta property="msapplication-TileImage" content="/favicons/mstile-150x150.png" />

    <meta name="twitter:site" content="@carlcassar" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:creator" content="@carlcassar" />

    <meta property="apple-mobile-web-app-status-bar-style" content="default" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    @if(app()->environment('production'))
        <script src="https://guppy.carlcassar.com/script.js" data-site="ISFHFHGE" defer></script>
    @endif

    <title>Carl Cassar {{ isset($title) ? ' - ' . $title : '' }}</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('/site.webmanifest') }}" rel="manifest">
    <link href="{{ asset('/favicons/favicon.ico') }}" rel="icon" type="image/x-icon">
    <link href="{{ asset('/favicons/favicon-16x16.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('/favicons/favicon-32x32.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('/favicons/safari-pinned-tab.svg') }}" rel="mask-icon" type="image/svg" sizes="693x693">
    <link href="{{ asset('/favicons/apple-touch-icon.png') }}" rel="apple-touch-icon" type="image/svg" sizes="180x180">

    @include('feed::links')

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
<div class="container mx-auto md:leading-relaxed md:tracking-wide text-gray-900 md:text-lg">
    <x-header />
    <div class="-mt-8 md:mt-0 px-4 md:px-16 lg:px-32 mb-20 max-w-full">
        {{ $slot }}
    </div>
    <x-footer />
</div>
@stack('scripts')
</body>
</html>
