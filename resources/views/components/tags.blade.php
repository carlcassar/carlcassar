<x-card class="sm:p-8">
    <x-slot name="title">
        Tags
    </x-slot>

    <ul>
        @foreach($tags as $tag)
            <li>
                <a class="capitalize text-orange-500 underline" href="/{{ $tag }}">{{ $tag }}</a>
            </li>
        @endforeach
    </ul>
</x-card>
