<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Livewire\NotificationSettings;
use Illuminate\Notifications\Messages\MailMessage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Testing (Local-only)
|--------------------------------------------------------------------------
*/

if (app()->environment('local')) {
    Route::get('/mail/welcome', function () {
        return (new MailMessage)
            ->subject('Welcome to carlcassar.com!')
            ->markdown('mail.welcome', ['name' => 'Carl Cassar'])
            ->render();
    });
}

/*
|--------------------------------------------------------------------------
| Guest (Unauthenticated)
|--------------------------------------------------------------------------
*/

// RSS
Route::feeds();

// Authentication
require __DIR__.'/auth.php';

// Home
Route::get('/', HomeController::class)->name('home');

// Privacy Policy
Route::get('privacy-policy', PrivacyPolicyController::class);

// Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Tags
Route::get('/tags', TagController::class)->name('tags');
Route::get('/tags/{tag}', fn ($tag) => redirect()->route('articles.index', compact('tag')));

/*
|--------------------------------------------------------------------------
| User (Authenticated)
|--------------------------------------------------------------------------
*/

// Authorised
Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);
});

// Authorised and Verified
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile
    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/settings/notifications', NotificationSettings::class)->name('settings.notifications');

    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
