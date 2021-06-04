<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use App\Models\Tag;
use App\Models\User;
use Inertia\Inertia;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Inertia\Response
     */
    public function show(Tag $tag)
    {
        return Inertia::render('Snippets/Tag/Show',[
            'snippets' => $tag->snippets()
                ->withStreetcred()
                ->orderBy('streetcred', 'DESC')
                ->with('user:id,name,profile_photo_path')
                ->with('tags:id,name,slug,color')
                ->select(['user_id', 'slug', 'title', 'excerpt', 'streetcred'])
                ->paginate(),
            'leaderBoard' => User::all('id', 'name', 'profile_photo_path')
                ->where('streetcred', '>', 0)
                ->sortByDesc('streetcred')
                ->values()
                ->take(10)
        ]);
    }
}
