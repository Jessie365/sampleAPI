<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public static function getPostsByCommentsCount() {

        return Post::selectRaw('posts.id, posts.title, posts.body, posts.user_id, posts.created_at, count(comments.id) as comments_count')
            ->leftjoin('comments', 'comments.post_id', '=', 'posts.id')
            ->groupBy('posts.id', 'posts.title', 'posts.body', 'posts.user_id', 'posts.created_at')
            ->orderBy('comments_count', 'desc')->get();
    }

    public static function getPostsByCreatedAt() {
        return Post::orderBy('created_at', 'desc')->get();
    }
}
