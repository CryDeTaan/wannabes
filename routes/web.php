<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StreetcredController;
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

Route::get('snippets', fn() => Inertia::render('Snippets/Create'));

Route::get('snippets/1', function () {

    $snippetFile = Laravel\Jetstream\Jetstream::localizedMarkdownPath('snippet.md');

    $environment = League\CommonMark\Environment::createCommonMarkEnvironment();
    $environment->addExtension(new League\CommonMark\Extension\GithubFlavoredMarkdownExtension());

    return Inertia::render('Snippets/Show', [
        'markdown' => (new League\CommonMark\CommonMarkConverter([], $environment))->convertToHtml(file_get_contents($snippetFile)),
    ]);
});

Route::get('about', function () {

    $aboutMarkdown = Laravel\Jetstream\Jetstream::localizedMarkdownPath('about.md');

    $environment = League\CommonMark\Environment::createCommonMarkEnvironment();
    $environment->addExtension(new League\CommonMark\Extension\GithubFlavoredMarkdownExtension());

    return Inertia::render('About', [
        'aboutMarkdown' => (new League\CommonMark\CommonMarkConverter([], $environment))->convertToHtml(file_get_contents($aboutMarkdown)),
    ]);
})->name('about');

Route::post('/snippets/{snippet}/streetcred', [StreetcredController::class, 'store']);
Route::delete('/snippets/{snippet}/streetcred', [StreetcredController::class, 'destroy']);
