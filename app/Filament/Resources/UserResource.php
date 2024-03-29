<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers\NotificationsRelationManager;
use App\Models\User;
use App\Notifications\Welcome;
use Filament\Forms;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->native(false)
                    ->nullable(),
                KeyValue::make('settings.notifications')
                    ->columnSpanFull()
                    ->keyLabel('Notification Key')
                    ->valueLabel('Is On?')
                    ->addable(false)
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Email Verified')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_admin')
                    ->label('Admin')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Sign In As User')
                    ->disabled(! auth()->user()->isAdmin())
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->requiresConfirmation()
                    ->iconButton()
                    ->action(function (User $user) {
                        auth()->login($user);

                        return redirect()->route('home');
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('Resend Welcome Email')
                        ->icon('heroicon-o-envelope')
                        ->requiresConfirmation()
                        ->action(function (Collection $users) {
                            $users->each(function (User $user) {
                                $user->notify(new Welcome());
                            });
                        }),
                    Tables\Actions\BulkAction::make('Resend Verification Email')
                        ->icon('heroicon-o-envelope')
                        ->requiresConfirmation()
                        ->action(function (Collection $users) {
                            $users->each(function (User $user) {
                                $user->sendEmailVerificationNotification();
                            });
                        }),
                ])
                    ->label('Emails')
                    ->icon('heroicon-o-envelope'),
                Tables\Actions\BulkAction::make('Verify Email')
                    ->icon('heroicon-o-check-circle')
                    ->requiresConfirmation()
                    ->action(function (Collection $records) {
                        User::whereIn('id', $records->pluck('id'))->update(['email_verified_at' => now()]);
                    }),
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            NotificationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
