<x-card class="p-4">
    <x-slot name="title">
        Tags
    </x-slot>

    <ul>
        @foreach($tags as $tag => $count)
            <li class="flex items-center justify-between space-x-2 my-1">
                <x-link class="no-underline" href="{{route('tags.show', $tag)}}">{{ $tag }}</x-link>
                <div
                    class="text-xs h-5 w-5 bg-gray-100 dark:bg-gray-700 rounded-full flex justify-center items-center">{{ $count }}</div>
            </li>
        @endforeach

        <li>
            <x-link class="block mt-4" :href="route('tags.index')">More Tags...</x-link>
        </li>
    </ul>
</x-card>
