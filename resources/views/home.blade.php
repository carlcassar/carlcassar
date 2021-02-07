<x-layout :title="Home">
    <x-banner />

    <div>
        <div class="lg:flex lg:flex-wrap">
            @foreach($articles as $article)
                @if ($loop->first)
                    <x-home.main :article="$article" />
                @else
                    <x-home.featured :article="$article" :odd="$loop->odd"/>
                @endif
            @endforeach
        </div>
    </div>
</x-layout>
