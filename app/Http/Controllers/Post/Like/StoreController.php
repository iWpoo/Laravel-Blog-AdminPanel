<?php

namespace App\Http\Controllers\Post\Like;

use App\Http\Controllers\Controller;
use App\Models\Post;

class StoreController extends Controller
{
    public function __invoke(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return response()->json([
            'likeContains' => auth()->user()->likedPosts->contains($post->id),
            'likesCount' => $post->likes->count()
        ]);
    }
}