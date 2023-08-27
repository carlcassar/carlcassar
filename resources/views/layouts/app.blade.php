@props([
    'title',
    'description',
    'keywords',
    'published_at'
])

@php
    $description = $description ?? "I'm Carl Cassar - a software developer and computer science professional. This is my personal blog about Laravel, PHP, Javascript, DevOps, Computation and more";
    $title = "Carl Cassar" . (isset($title) ? ' - ' . $title : '');
@endphp

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ request()->fullUrlWithoutQuery('page') }}"/>

    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords ?? "PHP, Laravel, JavaScript, Vue, Nuxt, DevOps, GitHub, Analytics" }}">

    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:description" content="{{ $description }}"/>
    <meta property="og:url" content="{{ config('app.url') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:updated_time" content="{{ now()->toIso8601String() }}"/>
    <meta property="og:image" content="{{ asset($ogImage ?? '/open-graph/logo1200x600.png') }}"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="600"/>

    <meta name="twitter:title" content="{{ $title }}"/>
    <meta name="twitter:description" content="{{ $description }}"/>
    <meta name="twitter:site" content="@carlcassar"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:creator" content="@carlcassar"/>
    <meta name="twitter:image" content="/icon.png"/>

    <link href="{{ asset('/site.webmanifest') }}" rel="manifest">
    <link href="{{ asset('/favicons/favicon.ico') }}" rel="icon" type="image/x-icon">
    <link href="{{ asset('/favicons/favicon-16x16.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('/favicons/favicon-32x32.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('/favicons/safari-pinned-tab.svg') }}" rel="mask-icon" type="image/svg" sizes="693x693">
    <link href="{{ asset('/favicons/apple-touch-icon.png') }}" rel="apple-touch-icon" type="image/svg" sizes="180x180">

    <x-feed-links/>

    <meta name="theme-color" content="#FFFFFF"/>
    <meta property="apple-mobile-web-app-status-bar-style" content="default"/>
    <meta name="apple-mobile-web-app-capable" content="yes">

    @if(app()->environment('production'))
        <script src="https://cdn.usefathom.com/script.js" data-site="ISFHFHGE" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if(request()->routeIs('articles.show'))
        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Article",
                "headline": "{{ $title }}",
                "author": {
                    "@type": "Person",
                    "name": "Carl Cassar"
                },
                "datePublished": "{{ $published_at }}",
                "keywords": "{{ $keywords }}",
                "description": "{{ $description }}"
            }
        </script>
    @endif

    @livewireStyles

</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-white dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-6 pb-12 lg:px-8 mt-6 md:flex md:space-x-4">
        <main class="md:w-2/3">

            <!-- Page Heading -->
            @if (isset($header))
                <header class="mb-4">
                    {{ $header }}
                </header>
            @endif

            <livewire:search-articles classes="md:hidden mb-4"/>

            {{ $slot }}
        </main>

        <aside class="md:w-64 lg:w-96 mt-4 md:mt-0 space-y-4">
            <livewire:search-articles/>

            @if(isset($aside))
                {{ $aside }}
            @endif

            <x-recents/>
            <x-tags/>
            <x-years/>
        </aside>

    </div>
    <x-footer/>
</div>
@livewireScripts
</body>
</html>
