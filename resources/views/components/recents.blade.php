<x-card class="sm:p-4">
    <x-slot name="title">
        Recent Articles
    </x-slot>

    <ul>
        @foreach($recents as $recent)
            <li>
                <x-link :href="route('articles.show', $recent)" :title="$recent->title" />
            </li>
        @endforeach
    </ul>
</x-card>
