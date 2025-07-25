<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'composer',
        'arranger',
        'duration',
        'date',
        'place',
        'artist',
        'comment',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'works_tags_relation');
    }
}
