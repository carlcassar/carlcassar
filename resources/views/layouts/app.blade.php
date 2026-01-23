<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!--suppress HtmlRequiredTitleElement -->
<head>
    <x-meta {{$attributes}} />

    <!-- Feed -->

    <x-feed-links />

    <!-- Scripts, Fonts, Styles -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (app()->environment('production'))
        <script src="https://cdn.usefathom.com/script.js" data-site="ISFHFHGE" defer></script>
    @endif

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

{{--    @livewireStyles--}}

{{--    @if (auth()->hasUser())--}}
{{--        @filamentStyles--}}
{{--    @endif--}}

</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-white dark:bg-gray-900">
    @include('layouts.navigation')

    <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-6">
        @if(isset($hero))
            <section class="mb-4">
                {{ $hero }}
            </section>
        @endif
    </div>

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-6 pb-12 lg:px-8 mt-6 md:flex md:space-x-4">
        <main class="md:w-2/3">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="mb-4">
                    {{ $header }}
                </header>
            @endif

            <div class="md:hidden mb-4">
                <livewire:search-articles classes="md:hidden mb-4" />

                @if (isset($before))
                    {{ $before }}
                @endif
            </div>

            {{ $slot }}
        </main>

        <aside class="md:w-64 lg:w-96 mt-4 md:mt-0 space-y-4">
            <livewire:search-articles />

            @if (isset($aside))
                {{ $aside }}
            @endif
        </aside>

    </div>
    <x-footer />
</div>

{{--@livewireScriptConfig--}}

{{--@if (auth()->hasUser())--}}
{{--    @filamentScripts()--}}
{{--@endif--}}

</body>

</html>
