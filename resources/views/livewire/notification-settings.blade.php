<div>
    <section id="notifications">
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Choose which email notifications you would like to receive.
        </p>

        <form wire:submit="create" class="mt-6 space-y-6">
            {{ $this->form }}

            {{--            <x-primary-button class="mt-4" type="submit">--}}
            {{--                Save--}}
            {{--            </x-primary-button>--}}
        </form>
    </section>

    <x-filament-actions::modals/>
</div>
