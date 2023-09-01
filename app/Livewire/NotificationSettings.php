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
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('settings.notifications.new_article_published', $state);
                                $set('settings.notifications.announcements', $state);

                                $this->user->settings()->notifications()->set('new_article_published', $state);
                                $this->user->settings()->notifications()->set('announcements', $state);
                            })
                            ->rules('boolean'),
                    ]),
                Section::make('Specifics')
                    ->description('Fine tune the notifications you\'d like to receive.')
                    ->schema([
                        Toggle::make('settings.notifications.new_article_published')
                            ->label('New Article Published')
                            ->onIcon('heroicon-o-check')
                            ->onColor('success')
                            ->live()
                            ->afterStateUpdated(function (Set $set, ?string $state, ?string $old) {
                                $this->user->update([
                                    'settings->notifications->new_article_published' => $state,
                                ]);
                                $set('all_notifications', $this->user->settings()->notifications()->areAllOn());
                            })
                            ->rules('boolean'),

                        Toggle::make('settings.notifications.announcements')
                            ->label('Announcements')
                            ->onIcon('heroicon-o-check')
                            ->onColor('success')
                            ->live()
                            ->afterStateUpdated(function (Set $set, ?string $state, ?string $old) {
                                $this->user->update([
                                    'settings->notifications->announcements' => $state,
                                ]);
                                $set('all_notifications', $this->user->settings()->notifications()->areAllOn());
                            })
                            ->rules('boolean'),
                    ]),
            ])
            ->statePath('data')
            ->model(auth()->user());
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
