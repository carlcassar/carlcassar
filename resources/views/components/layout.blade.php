<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <title>Carl Cassar</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="{{ mix('/js/app.js') }}"></script>

    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/app.js') }}"></script>

    @include('feed::links')

</head>
<body>
<div class="container mx-auto md:leading-relaxed md:tracking-wide text-gray-900 md:text-lg">
    <x-header/>
    <div class="-mt-8 md:mt-0 px-4 md:px-16 lg:px-32 mb-20 max-w-full">
        {{ $slot }}
    </div>
    <x-footer/>
</div>
</body>
</html>
