<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Concert extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'title',
        'date',
        'place',
        'open',
        'start',
        'program',
        'comment',
    ];

    // この投稿を所有するユーザー（Adminモデルとの関係を定義）
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
