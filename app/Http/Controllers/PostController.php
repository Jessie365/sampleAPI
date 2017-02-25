<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Post;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response = [
                'posts' => []
            ];

            $posts = Post::orderBy('created_at', 'desc')->get();
            $statusCode = 200;
            foreach($posts as $post) {
                $response['posts'][] = [
                    'id' => $post->id,
                    'title' => $post->title,
                    'body' => $post->body,
                    'user_id' => $post->user_id,
                    'created_at' => $post->created_at
                ];
            }
        } catch (Exception $ex) {
            $statusCode = 404;
        } finally {
            return response()->json($response, $statusCode);
        }
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json(['User Not Found'], 404);
        }

        //validate the input
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|unique:posts,title',
            'body' => 'required|min:3',
        ]);
        //check if there are validation errors
        $errorsArray = $validator->errors()->toArray();
        if (!empty($errorsArray)) {
            return response()->json($errorsArray);
        }

        //create new post and fill the user id
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => $user->id
        ]);

        //save it and return response
        return response()->json('Post created Successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        $statusCode = 200;
        $response = '';
        try {
            $post = Post::findOrFail($postId);
            $response = $post;

        } catch (ModelNotFoundException $ex) {
            $statusCode = 404;
            $response = 'Post Not Found'; //TO DO - format the errors
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
