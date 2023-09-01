<x-card class="p-6">
    <x-slot name="title">
        Settings
    </x-slot>

    <ul class="space-y-2">
        <li>
            <x-link :href="route('profile.edit')">Profile</x-link>
        </li>
        <li>
            <x-link :href="route('settings.notifications')">Notifications</x-link>
        </li>
    </ul>
</x-card>
