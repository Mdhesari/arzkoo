<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('expire_at', '>', now());
    }

    public function save(array $options = [])
    {
        if (is_null($this->expire_at)) {
            $this->expire_at = now()->addMinutes(120);
        }

        return parent::save();
    }
}
