<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class SnippetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('show');
        $this->authorizeResource(Snippet::class, 'snippet', [
            'except' => [ 'index', 'show' ],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Snippets/Create', [
            'tags' => Tag::all(['id', 'slug', 'name', 'color']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateSnippet();

        $snippet = auth()->user()->snippets()->create(request(['title', 'excerpt', 'markdown']));
        $snippet->tags()->attach(request('tags'));
        $snippet->giveStreetcred();

        return redirect(
            route('snippets.show', $snippet->slug)
        )->with('success', 'Snippet created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Snippet  $snippet
     * @return \Inertia\Response
     */
    public function show(Snippet $snippet)
    {
        // Convert markdown to HTML
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $markdown = (new CommonMarkConverter([
            'html_input' => 'escape',
            'allow_unsafe_links' => false
        ], $environment))->convertToHtml($snippet->markdown);

        return Inertia::render('Snippets/Show', [
            'snippet' => [
                'slug'      => $snippet->slug,
                'title'      => $snippet->title,
                'excerpt'    => $snippet->excerpt,
                'tags'       => $snippet->tags,
                'created_at' => $snippet->created_at->toFormattedDateString(),
                'markdown'   => $markdown,
                'gaveStreetcred' => $snippet->gaveStreetcred,
                'streetcred' => $snippet->streetcred->count(),
                'user'       => $snippet->user->only('name', 'profile_photo_url', 'streetcred'),
            ],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Snippet  $snippet
     * @return \Inertia\Response
     */
    public function edit(Snippet $snippet)
    {

        return Inertia::render('Snippets/Edit', [
            'snippet' => [
                'slug'      => $snippet->slug,
                'title'      => $snippet->title,
                'excerpt'    => $snippet->excerpt,
                'tags'       => $snippet->tags,
                'created_at' => $snippet->created_at->toFormattedDateString(),
                'markdown'   => $snippet->markdown,
                'streetcred' => $snippet->streetcred->count(),
                'user'       => $snippet->user->only('name', 'profile_photo_url', 'streetcred'),
            ],
            'allTags' => Tag::all(['id', 'slug', 'name', 'color']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Snippet  $snippet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Snippet $snippet)
    {
        $this->validateSnippet();

        $snippet->update(request(['title', 'excerpt', 'markdown']));
        $snippet->tags()->sync(request('tags'));

        return redirect(
            route('snippets.show', $snippet->slug)
        )->with('success', 'Snippet created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Snippet  $snippet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Snippet $snippet)
    {
        $snippet->delete();

        return redirect(
            route('user.snippets', auth()->user()->name)
        )->with('success', 'Snippet deleted.');
    }

    protected function validateSnippet()
    {
        return request()->validate([
            'title'     => ['required', 'string', 'max:30'],
            'excerpt'   => ['required', 'string', 'max:35'],
            'markdown'  => ['required', 'string', 'max:4094'],
            'tags'      => ['exists:tags,id'],
        ]);
    }
}
