<x-card class="sm:p-4">
    <x-slot name="title">
        Years
    </x-slot>

    <ul>
        @foreach($years as $year)
            <li>
                <x-link href="/{{$year}}">{{$year}}</x-link>
            </li>
        @endforeach
    </ul>
</x-card>
