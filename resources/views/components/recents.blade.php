<x-card class="sm:p-8">
    <x-slot name="title">
        Recent Articles
    </x-slot>

    <ul>
        @foreach($recents as $recent)
            <li>
                <a class="capitalize text-orange-500 underline"
                   href="/articles/{{ $recent->slug }}">{{ $recent->title }}</a>
            </li>
        @endforeach
    </ul>
</x-card>
