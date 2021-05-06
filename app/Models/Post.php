<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use TCG\Voyager\Models\Post as BasePost;

class Post extends BasePost
{
    use HasFactory;

    public function getFullImageUrlAttribute()
    {
        return url(Storage::url($this->image));
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
