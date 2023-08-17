<x-card class="sm:p-4">
    <x-slot name="title">
        Recent Articles
    </x-slot>

    <ul>
        @foreach($recents as $recent)
            <li class="mb-2">
                <x-link class="no-underline" :href="route('articles.show', $recent)">{{$recent->title}}</x-link>
            </li>
        @endforeach
    </ul>
</x-card>
