<?php

namespace App\Http\Controllers;

use phpDocumentor\Reflection\Types\Integer;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

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
     * @param  Integer  $postId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postId)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json(['User Not Found'], 404);
        }

        $post = Post::find($postId);
        if (!$post) {
            return response()->json(['Post Not Found'], 404);
        }

        //validate the input
        $validator = Validator::make($request->all(), [
            'body' => 'required|min:6',
        ]);
        //check if there are validation errors
        $errorsArray = $validator->errors()->toArray();
        if (!empty($errorsArray)) {
            return response()->json($errorsArray);
        }

        //create new comment and fill the post_id and the user_id
        Comment::create([
            'body' => request('body'),
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        //save it and return response
        return response()->json('Comment created Successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
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
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
