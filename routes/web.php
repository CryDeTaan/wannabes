<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SnippetController;
use App\Http\Controllers\StreetcredController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', HomeController::class)->name('home');

Route::resource('snippets', SnippetController::class);

Route::get('about', function () {

    $aboutMarkdown = Laravel\Jetstream\Jetstream::localizedMarkdownPath('about.md');

    $environment = League\CommonMark\Environment::createCommonMarkEnvironment();
    $environment->addExtension(new League\CommonMark\Extension\GithubFlavoredMarkdownExtension());

    return Inertia::render('About', [
        'aboutMarkdown' => (new League\CommonMark\CommonMarkConverter([], $environment))->convertToHtml(file_get_contents($aboutMarkdown)),
    ]);
})->name('about');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/snippets/{snippet}/streetcred', [StreetcredController::class, 'destroy']);
    Route::post('/snippets/{snippet}/streetcred', [StreetcredController::class, 'store']);
});

Route::get('/users/{user}/', [UserController::class, 'show']);
Route::get('/tags/{tag}/', [TagController::class, 'show']);
