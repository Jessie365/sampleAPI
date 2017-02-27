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
        $response['message'] = 'Comment created Successfully';

        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            $response['message'] = 'User Not Found';
            return response()->json($response, 400);
        }

        $post = Post::find($postId);
        if (!$post) {
            $response['message'] = 'Post Not Found';
            return response()->json($response, 400);
        }

        //validate the input
        $validator = Validator::make($request->all(), [
            'body' => 'required|min:6',
        ]);
        //check if there are validation errors
        $errorsArray = $validator->errors()->toArray();
        if (!empty($errorsArray)) {
            $response['message'] = 'Validation Failed';
            $response['validationFieldErrors'] = $errorsArray;
            return response()->json($response, 400);
        }

        //create new comment and fill the post_id and the user_id
        Comment::create([
            'body' => request('body'),
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);

        //save it and return response
        return response()->json($response, 201);
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
