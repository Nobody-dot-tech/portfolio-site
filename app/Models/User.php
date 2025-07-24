<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function loadRelationshipCounts()
    {
        $this->loadCount(['goods', 'comments']);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function goods()
    {
        return $this->belongsToMany(Blog::class, 'goods', 'user_id', 'blog_id')->withTimestamps();
    }

    public function become_good(int $blogId)
    {
        $exist = $this->is_gooding($blogId);

        if ($exist) {
            return false;
        } else {
            $this->goods()->attach($blogId);
            return true;
        }
    }

    public function cancel_good(int $blogId)
    {
        $exist = $this->is_gooding($blogId);

        if ($exist) {
            $this->goods()->detach($blogId);
            return true;
        } else {
            return false;
        }
    }

    public function is_gooding(int $blogId)
    {
        return $this->goods()->where('blog_id', $blogId)->exists();
    }

    public function feed_goods()
    {
        $goodIds = $this->goods()->pluck('goods.id')->toArray();
        return Blog::whereIn('id', $goodIds);
    }
}
