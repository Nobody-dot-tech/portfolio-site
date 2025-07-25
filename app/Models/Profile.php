<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'bio',
        'photo_path',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
