<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\PostUserLike;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'postUserLikedCount' => PostUserLike::count(),
            'commentCount' => Comment::count(),
        ];
        return view('personal.main.index', compact('data'));
    }
}