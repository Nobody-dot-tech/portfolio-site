<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

    public function all_blogs()
    {
        $blogIds = $this->blogs()->pluck('blogs.id')->toArray();
        return Blog::whereIn('id', $blogIds);
    }

    public function concerts()
    {
        return $this->hasMany(Concert::class);
    }

    public function all_concerts()
    {
        $concertIds = $this->concerts()->pluck('concerts.id')->toArray();
        return Concert::whereIn('id', $concertIds);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function all_works()
    {
        $workIds = $this->concerts()->pluck('works.id')->toArray();
        return Concert::whereIn('id', $workIds);
    }

    public function loadRelationshipCounts()
    {
        $this->loadCount(['blogs', 'concerts']);
    }
}
