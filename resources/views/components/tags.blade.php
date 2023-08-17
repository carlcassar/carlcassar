<x-card class="sm:p-4">
    <x-slot name="title">
        Tags
    </x-slot>

    <ul>
        @foreach($tags as $tag)
            <li>
                <x-link href="/{{ $tag }}" :title="$tag" />
            </li>
        @endforeach
    </ul>
</x-card>
