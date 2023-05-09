<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
use App\Models\PostUserLike;
use App\Models\Comment;

class IndexController extends Controller
{
    public function __invoke()
    {
        $data = [
            'postUserLikedCount' => PostUserLike::count(),
            'commentCount' => Comment::count(),
        ];
        return view('personal.main.index', compact('data'));
    }
}