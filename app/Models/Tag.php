<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Work;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function works()
    {
        return $this->belongsToMany(Work::class, 'works_tags_relation');
    }
}
