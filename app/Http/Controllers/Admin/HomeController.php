<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'usersCount' => User::count(),
            'postsCount' => Post::count(),
            'categoriesCount' => Category::count(),
            'tagsCount' => Tag::count(),
        ];
        return view('admin.main.index', compact('data'));
    }
}