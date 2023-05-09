<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class DeleteController extends BaseController
{
    public function __invoke(Post $post)
    {
        Storage::disk('public')->delete('images', $post->preview_image);
        Storage::disk('public')->delete('images', $post->main_image);
        $post->tags()->detach();  
        $post->delete();   
        return redirect()->route('admin.post.index')->with('success', 'Запись была удалена');
    }
}