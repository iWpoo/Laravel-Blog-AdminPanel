<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(Request $request)
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

        $title = 'Blogname';

        return view('post.index', compact('posts', 'recentPosts', 'title'));
    }

    public function show(Post $post)
    {
        $date = Carbon::parse($post->created_at);

        $recentPosts = Post::where('created_at', '>=', Carbon::now()->subWeek())
        ->orderBy('views', 'desc')
        ->get()
        ->take(20);
        
        $post->incrementViews();

        $title = $post->title;

        return view('post.show', compact('post', 'date', 'recentPosts', 'title'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        $posts = Post::search($query)->paginate(10);

        foreach ($posts as $post) {
            $post->date = Carbon::parse($post->created_at);
        }

        $title = $query;

        return view('post.search', compact('posts', 'query', 'title'));
    }
}