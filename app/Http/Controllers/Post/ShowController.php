<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $date = Carbon::parse($post->created_at);

        $recentPosts = Post::where('created_at', '>=', Carbon::now()->subWeek())
        ->orderBy('views', 'desc')
        ->get()
        ->take(20);
        
        $post->incrementViews();

        return view('post.show', [
            'post' => $post,
            'date' => $date,
            'recentPosts' => $recentPosts,
            'title' => $post->title
        ]);
    }
}