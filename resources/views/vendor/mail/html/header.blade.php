@props(['url'])
<tr class="header">
    <td class="header">
        <a href="{{ route('home') }}" alt="Go Home" aria-label="Go Home" style="display:inline-block">
            <x-application-logo style="
                width: 30px;
                height: 30px;
                border-radius: 3px;
                vertical-align: middle
            "/>
        </a>
    </td>
</tr>

<tr>
    <td class="header">

        <a href="{{ route('home') }}"
           class="ml-4 mr-2 pb-1 inline-flex items-center text-2xl font-semibold transition-all duration-200 cursor-pointer dark:text-white hover:text-orange-500">
            carlcassar.com
        </a>

        {{ $slot }}
    </td>
</tr>
