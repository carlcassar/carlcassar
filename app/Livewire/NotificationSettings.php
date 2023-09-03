<?php

namespace App\Livewire;

use App\Models\User;
use Arr;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Livewire\Component;
use Str;

class NotificationSettings extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public User $user;

    public function mount(): void
    {
        $this->user = auth()->user();

        $this->form->fill(
            array_merge($this->user->toArray(),
                ['all_notifications' => $this->user->settings()->notifications()->areAllOn()])
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General')
                    ->description('Enable / Disable all notifications.')
                    ->compact()
                    ->collapsible()
                    ->schema([
                        Toggle::make('all_notifications')
                            ->label('All Notifications')
                            ->onIcon('heroicon-o-check')
                            ->onColor('success')
                            ->live()
                            ->afterStateUpdated(fn (Set $set, ?bool $state) => $this->setAllNotifications($set, $state))
                            ->rules('boolean'),
                    ]),
                Section::make('Specifics')
                    ->description('Fine tune the notifications you\'d like to receive.')
                    ->schema($this->notificationFields()),
            ])
            ->statePath('data')
            ->model(auth()->user());
    }

    public function setAllNotifications(Set $set, ?bool $state): void
    {
        \App\Models\NotificationSettings::defaultNotificationSettings()->each(function ($value, $key) use (
            $set,
            $state
        ) {
            $set("settings.notifications.$key", $state);
            $this->setNotification($key, $set, $state);
        });
    }

    public function setNotification($ket, Set $set, ?bool $state): void
    {
        $this->user->settings()->notifications()->set($ket, $state);

        $set('all_notifications', $this->user->settings()->notifications()->areAllOn());
    }

    private function notificationFields()
    {
        return \App\Models\NotificationSettings::defaultNotificationSettings()->map(function ($value, $key) {
            return Toggle::make("settings.notifications.$key")
                ->label(Str::of($key)->replace('_', ' ')->title())
                ->onIcon('heroicon-o-check')
                ->onColor('success')
                ->live()
                ->afterStateUpdated(fn (Set $set, ?string $state) => $this->setNotification($key, $set, $state))
                ->rules('boolean');
        })->toArray();
    }

    public function state(string $key)
    {
        return Arr::get($this->form->getState(), $key);
    }

    public function render()
    {
        return view('livewire.notification-settings')
            ->title('Notifications')
            ->layout('layouts.settings');
    }
}
