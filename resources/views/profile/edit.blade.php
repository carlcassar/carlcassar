<x-settings-layout title="Profile">
    <div class="space-y-4">
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')

        @include('profile.partials.delete-user-form')
    </div>
</x-settings-layout>
