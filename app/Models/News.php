<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'title', 'body', 'likes', 'dislikes', 'image',
    ];

    protected $casts = [
        'likes' => 'integer',
        'dislikes' => 'integer',
        'meta' => 'array',
    ];

    public function scopeFavourite($query, $count = 50)
    {
        return $query->where('likes', '>=', $count);
    }
}
