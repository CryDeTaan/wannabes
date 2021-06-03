<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
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
        return Inertia::render('Home',[
            'snippets' => Snippet::withStreetcred()
                ->orderBy('streetcred', 'DESC')
                ->with('user:id,name,profile_photo_path')
                ->with('tags:id,name,slug,color')
                ->select(['id', 'user_id', 'slug', 'title', 'excerpt', 'streetcred'])
                ->paginate(),
            'leaderBoard' => User::all('id', 'name', 'profile_photo_path')
                ->where('streetcred', '>', 0)
                ->sortByDesc('streetcred')
                ->values()
                ->take(10)
        ]);
    }
}
