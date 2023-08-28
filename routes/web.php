<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Models\User;
use App\Notifications\Welcome;
use Illuminate\Support\Facades\Route;

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

Route::get('/logout', AuthenticatedSessionController::class . '@destroy');

Route::get('/', HomeController::class)->name('home');
Route::get('privacy-policy', PrivacyPolicyController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('articles', ArticleController::class)->only([
    'index',
    'show',
]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/tags', TagController::class)->name('tags');

Route::get('/tags/{tag}', function ($tag) {
    return redirect()->route('articles.index', ['tag' => $tag]);
});

Route::get('mail-test', function () {
    User::first()->notify(new Welcome);
});

require __DIR__.'/auth.php';

Route::feeds();
