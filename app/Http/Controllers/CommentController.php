<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Snippet;

class CommentController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request, Snippet $snippet)
    {
        $this->validateComment();

        $snippet->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        return redirect(
            route('snippets.show', $snippet->slug)
        )->with('success', 'Comment added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Snippet $snippet, Comment $comment)
    {
        $this->validateComment();

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect(
            route('snippets.show', $snippet->slug)
        )->with('success', 'Comment added.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Snippet $snippet, Comment $comment)
    {
        $comment->delete();

        return redirect(
            route('snippets.show', $snippet->slug)
        )->with('success', 'Comment added.');
    }

    protected function validateComment()
    {
        return request()->validate([
            'body'     => ['required', 'string', 'max:255'],
        ]);
    }
}
