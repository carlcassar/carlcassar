<x-app-layout title="Privacy Policy">
    <x-slot name="header">
        <h1 class="font-extrabold text-3xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Privacy Policy') }}
        </h1>
    </x-slot>

    <h2 class="text-xl mb-3">Analytics</h2>

    <p class="mb-8">
        I take your privacy very seriously. I've recently switched from Google Analytics to a privacy-focused
        cookie-free solution called
        <x-link href="https://usefathom.com/ref/QR9NX6">Fathom</x-link>
        .
        Fathom <strong>doesn't use any cookies</strong> and doesn't collect <strong>any personal information</strong>.
        <x-link href="https://usefathom.com/ref/QR9NX6/privacy-focused-web-analytics">Read this article about
            privacy-focused analytics
        </x-link>
        if you want to know more.
    </p>

    {{--    <h2 class="text-xl mb-8">Cookies</h2>--}}

    {{--    <p class="mb-8">--}}
    {{--        Cookies are small text files that are placed on your computer by websites that you visit. They are widely--}}
    {{--        used in order to make websites work, or work more efficiently, as well as to provide information to the--}}
    {{--        owners of the site.--}}
    {{--    </p>--}}
</x-app-layout>
