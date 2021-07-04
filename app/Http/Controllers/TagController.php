<?php

namespace App\Http\Controllers;

use App\Mail\TagRequest;
use Illuminate\Support\Facades\Mail;
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
                ->with('user:id,name,profile_photo_path')
                ->with('tags:id,name,slug,color')
                ->select(['user_id', 'slug', 'title', 'excerpt'])
                ->withCount('streetcred')
                ->orderBy('streetcred_count', 'desc')
                ->paginate(),
            'leaderBoard' => User::all('id', 'name', 'streetcred', 'profile_photo_path')
                ->where('streetcred', '>', 0)
                ->sortByDesc('streetcred')
                ->values()
                ->take(10),
        ]);
    }

    public function requestTag()
    {
        request()->validate([
            'name' => ['required', 'string', 'max:20', 'unique:tags'],
        ]);

        Mail::to(config('app.support_email'))
            ->send(new TagRequest(
                auth()->user(),
                request()->name,
            ));

        return back();
    }
}
