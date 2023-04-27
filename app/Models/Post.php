<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;

    public static function search($query)
    {
        return self::whereRaw("MATCH(title, content) AGAINST(? IN BOOLEAN MODE)", [$query]);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(PostUserLike::class, 'post_id', 'id');
    }

    public function incrementViews()
    {
        $this->views = Cache::remember('post_views_'.$this->id, now()->addHour(), function () {
            return $this->views + 1;
        });
        $this->save();
    }

    public function views()
    {
        return Cache::get('post_views_'.$this->id, $this->views);
    }
}
