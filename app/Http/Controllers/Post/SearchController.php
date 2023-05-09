<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $request->input('q');

        $posts = Post::search($query)->paginate(1);

        foreach ($posts as $post) {
            $post->date = Carbon::parse($post->created_at);
        }

        $title = $query;

        return view('post.search', compact('posts', 'query', 'title'));
    }
}