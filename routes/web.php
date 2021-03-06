<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleOpenGraphImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::feeds();

Route::get('/', HomeController::class)->name('home');
Route::get('search', SearchController::class)->name('search');
Route::get('privacy-policy', PrivacyPolicyController::class)->name('privacy-policy');

Route::resource('tags', TagController::class)->only('index', 'show');
Route::resource('articles', ArticleController::class)->only('index', 'show');

Route::get('articles/{article}/open-graph-image', ArticleOpenGraphImageController::class)
    ->name('articles.open-graph-image');

