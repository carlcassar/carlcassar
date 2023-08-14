<x-card class="sm:p-8">
    <x-slot name="title">
        Years
    </x-slot>

    <ul>
        @foreach($years as $year)
            <li>
                <a class="capitalize text-orange-500 underline" href="/{{ $years }}">{{ $year }}</a>
            </li>
        @endforeach
    </ul>
</x-card>
