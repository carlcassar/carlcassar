<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
</div>
<x-footer />
</body>
</html>
