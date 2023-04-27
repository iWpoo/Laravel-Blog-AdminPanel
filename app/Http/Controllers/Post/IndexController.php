<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $posts = Post::where('created_at', '>=', Carbon::now()->subMonth())
            ->orderBy('views', 'desc')
            ->paginate(10);

        foreach ($posts as $post) {
            $post->date = Carbon::parse($post->created_at);
        }  
         
        $recentPosts = Post::where('created_at', '>=', Carbon::now()->subWeek())
        ->orderBy('views', 'desc')
        ->get()
        ->take(20);    

        return view('post.index', [
            'posts' => $posts,
            'recentPosts' => $recentPosts,
            'title' => 'Blogname'
        ]);
    }
}