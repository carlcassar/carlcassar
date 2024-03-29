<x-card class="p-4">
    <x-slot name="title">
        Tags
    </x-slot>

    <ul>
        @foreach($tags as $tag => $count)
            <li class="flex items-center justify-between space-x-2 my-1">
                <x-link class="no-underline" href="/articles/?tag={{ $tag }}">{{ $tag }}</x-link>
                <div class="text-xs h-5 w-5 bg-gray-100 dark:bg-gray-700 rounded-full flex justify-center items-center">{{ $count }}</div>
            </li>
        @endforeach

        <x-link class="block mt-4" :href="route('tags')">More Tags...</x-link>
    </ul>
</x-card>
