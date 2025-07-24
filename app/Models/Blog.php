<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    // この投稿を所有するユーザー（Adminモデルとの関係を定義）
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount('admins');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function good_users()
    {
        return $this->belongsToMany(User::class, 'goods', 'blog_id', 'user_id')->withTimestamps();
    }
}
