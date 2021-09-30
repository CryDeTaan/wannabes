<?php

use App\Http\Controllers\StreetcredController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SnippetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

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

Route::get('/', HomeController::class)->name('home')->middleware('remember');

Route::resource('snippets', SnippetController::class);
Route::resource('snippets.comments', CommentController::class);

Route::get('about', function () {

    $aboutMarkdown = Laravel\Jetstream\Jetstream::localizedMarkdownPath('about.md');

    $markdown = Str::markdown(file_get_contents($aboutMarkdown), [
        // Be careful with the setting below, in this case
        // it's not processing user controlled content
        //'html_input' => 'escape',
        'allow_unsafe_links' => false,
        'max_nesting_level' => 100,
    ]);

    return Inertia::render('About', [
        'aboutMarkdown' => $markdown
    ]);
})->name('about');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/snippets/{snippet}/streetcred', [StreetcredController::class, 'destroy']);
    Route::post('/snippets/{snippet}/streetcred', [StreetcredController::class, 'store']);
});

Route::get('/users/{user}/', [UserController::class, 'show'])->name('user.snippets');
Route::get('/tags/{tag}/', [TagController::class, 'show']);
Route::post('/tags/request-tag', [TagController::class, 'requestTag'])->name('tags.request')->middleware('auth:sanctum');
