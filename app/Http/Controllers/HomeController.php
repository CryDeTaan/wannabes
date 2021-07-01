<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $snippets = Snippet::search($request->search)->paginate()->withQueryString();
        $snippets->load(
            'user:id,name,profile_photo_path',
            'tags:id,name,slug,color'
        );
        $snippets->appends('query', null);

        return Inertia::render('Home',[
            'snippets' => $snippets,
            'leaderBoard' => User::all('id', 'name', 'profile_photo_path')
                ->where('streetcred', '>', 0)
                ->sortByDesc('streetcred')
                ->values()
                ->take(10),
            'tags' => Tag::all(['id', 'slug', 'name', 'color']),
        ]);
    }
}
