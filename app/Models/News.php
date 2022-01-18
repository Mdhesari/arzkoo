<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'title', 'body', 'likes', 'dislikes', 'image', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'likes' => 'integer',
        'dislikes' => 'integer',
        'meta' => 'array',
    ];

    public function scopeFavourite($query, $count = 50)
    {
        return $query->where('likes', '>', $count);
    }

    public function shareToTelegram()
    {
        return $this->forceFill([
            'meta->shared_telegram' => true,
        ])->save();
    }

    public function scopeExceptAlreadySharedToTelegram($query)
    {
        return $query->whereJsonContains('meta->shared_telegram', false);
    }
}
