<div>
    <div class="text-3xl leading-snug mb-8 text-center font-light">
    {{ $title ?? 'Title'}}
    </div>

    <div>
        {{ $slot }}
    </div>

    <div class="flex justify-center my-10">
        <div class="border-t w-64 border-gray-200"></div>
    </div>
</div>
