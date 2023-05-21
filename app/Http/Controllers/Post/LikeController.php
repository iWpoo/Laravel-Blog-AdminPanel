<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return response()->json([
            'likeContains' => auth()->user()->likedPosts->contains($post->id),
            'likesCount' => $post->likes->count()
        ]);
    }
}