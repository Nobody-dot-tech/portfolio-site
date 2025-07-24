<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'admin_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verfied_at' => 'datetime'
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount(['blogs']);
    }

    public function all_blogs()
    {
        $blogIds = $this->blogs()->pluck('blogs.id')->toArray();
        return Blog::whereIn('id', $blogIds);
    }
}
