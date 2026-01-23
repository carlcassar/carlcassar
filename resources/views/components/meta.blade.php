@props([
    'title' => '',
    'description' => "I'm Carl Cassar - a software developer and computer science professional. This is my personal blog about Laravel, PHP, Javascript, DevOps, Computation and more.",
    'keywords' => 'PHP, Laravel, JavaScript, Vue, Nuxt, DevOps, GitHub, Analytics',
    'ogImage' => '/open-graph/logo1200x630.png',
    'updatedAt' => now()->toIso8601String(),
    'publishedAt',
 ])

@php
    $title = Str::of($title)
        ->when(empty($title), fn(Illuminate\Support\Stringable $title) => $title->prepend('Carl Cassar'))
        ->when(filled($title), fn(Illuminate\Support\Stringable $title) => $title->prepend('Carl Cassar - '));
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="canonical" href="{{ request()->fullUrl() }}" />

<title>{{$title}}</title>
<meta name="description" content="{!! $description !!}">
<meta name="keywords" content="{!! $keywords !!}">

<link rel="sitemap" type="application/xml" title="Sitemap" href={{url('sitemap.xml')}}>

<meta property="og:title" content="{!! $title !!}" />
<meta property="og:description" content="{!! $description !!}" />
<meta property="og:url" content="{{ request()->fullUrl() }}" />
<meta property="og:type" content="website" />
<meta property="og:updated_time" content="{!! $updatedAt !!}" />
<meta property="og:image" content="{{ asset($ogImage ?? '/open-graph/logo1200x630.png') }}" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />

<meta name="twitter:title" content="{!! $title !!}" />
<meta name="twitter:description" content="{!! $description  !!}" />
<meta name="twitter:site" content="@carlcassar" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:creator" content="@carlcassar" />
<meta name="twitter:image" content="{{ asset($ogImage ?? '/open-graph/logo1200x630.png') }}" />

<meta name="theme-color" content="#FFFFFF" />
<meta property="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-capable" content="yes">

<link href="{{ asset('/site.webmanifest') }}" rel="manifest">
<link href="{{ asset('/favicons/favicon.ico') }}" rel="icon" type="image/x-icon">
<link href="{{ asset('/favicons/favicon-16x16.png') }}" rel="icon" type="image/png">
<link href="{{ asset('/favicons/favicon-32x32.png') }}" rel="icon" type="image/png">
<link href="{{ asset('/favicons/safari-pinned-tab.svg') }}" rel="mask-icon" type="image/svg" sizes="693x693">
<link href="{{ asset('/favicons/apple-touch-icon.png') }}" rel="apple-touch-icon" type="image/svg" sizes="180x180">

@if (request()->routeIs('articles.show'))
    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@type": "Article",
            "headline": "{!! $title !!}",
                "author": {
                    "@type": "Person",
                    "name": "Carl Cassar"
                },
                "datePublished": "{!! $publishedAt !!}",
                "dateModified": "{!! $updatedAt !!}",
                "keywords": "{!! $keywords !!}",
                "description": "{!! $description !!}"
            }
    </script>
@endif
