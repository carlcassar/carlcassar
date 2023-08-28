<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
    <div>
        <a href="{{ route('home') }}" alt="Go Home" aria-label="Go Home">
            <x-application-logo style="
                width: 30px;
                height: 30px;
                border-radius: 3px;
                vertical-align: middle
            "/>
        </a>

        <a href="{{ route('home') }}"
           class="ml-4 mr-2 pb-1 inline-flex items-center text-2xl font-semibold transition-all duration-200 cursor-pointer dark:text-white hover:text-orange-500">
            carlcassar.com
        </a>
    </div>
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
