<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Service\PostService;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        
        return redirect()->route('admin.post.index')->with('success', 'Запись была удалена')->with('success', 'Запись было добавлено');
    }

    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $this->service->update($data, $post);
        
        return redirect()->route('admin.post.show', $post->id)->with('success', 'Запись была обновлена');
    }

    public function delete(Post $post)
    {
        Storage::disk('public')->delete('images', $post->preview_image);
        Storage::disk('public')->delete('images', $post->main_image);
        $post->tags()->detach();  
        $post->delete();   
        return redirect()->route('admin.post.index')->with('success', 'Запись была удалена');
    }
}