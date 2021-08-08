<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'exchange_id',
        'ease_of_use_range',
        'support_range',
        'value_for_money_range',
        'verification_range',
    ];

    protected $casts = [
        'ease_of_use_range' => 'float',
        'support_range' => 'float',
        'value_for_money_range' => 'float',
        'verification_range' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
