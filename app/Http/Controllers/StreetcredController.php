<?php

namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;

class StreetcredController extends Controller
{
    /**
     * Add streetcred for snippet
     * @param Snippet $snippet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Snippet $snippet)
    {
        $snippet->giveStreetcred();

        return back();
    }

    /**
     * Remove streetcred for snippet
     * @param Snippet $snippet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Snippet $snippet)
    {

        $snippet->removeStreetcred();

        return back();
    }
}
