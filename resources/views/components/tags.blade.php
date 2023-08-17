<x-card class="sm:p-4">
    <x-slot name="title">
        Tags
    </x-slot>

    <ul>
        @foreach($tags as $tag)
            <li>
                <x-link class="no-underline" href="/articles/?tag={{ $tag }}">{{ $tag }}</x-link>
            </li>
        @endforeach
    </ul>
</x-card>
