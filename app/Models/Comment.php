<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Blog;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'user_id','blog_id'];// 追記して想定外のデータが代入されるのを防ぎ、なおかつ、一気にデータを代入することが可能にする。

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}