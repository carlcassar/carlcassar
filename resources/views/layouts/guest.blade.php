<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!--suppress HtmlRequiredTitleElement -->
<head>
    <x-meta {{$attributes}} />

    <!-- Scripts, Fonts, Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @if(app()->environment('production'))
        @turnstileScripts()
    @endif
</head>

<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col items-center pt-20 bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col items-center">
        <a href="/">
            <x-application-logo class="w-14 h-14 fill-current text-gray-500" />
        </a>
        <a href="{{ route('home') }}"
           class="pt-4 text-2xl font-semibold transition-all duration-200 cursor-pointer dark:text-white hover:text-orange-500">
            carlcassar.com
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>
