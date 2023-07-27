<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments= Comment::all();
        return view('comments.index', ['comments'=>$comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request)
    {
        $comment = new Comment;
		$comment->comment = $request->input('comment');
		$comment->post_id = $request->input('post_id');
        $comment->save();

        return to_route('comments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.show',['comment'=>$comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit',['comment'=>$comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
		$comment->comment = $request->input('comment');
		$comment->post_id = $request->input('post_id');
        $comment->save();

        return to_route('comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return to_route('comments.index');
    }
}
