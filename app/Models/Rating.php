<?php

namespace App\Models;

use DB;
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

    public function scopeCaclulateItemsRate($query)
    {
        return $query->select(
            DB::raw('SUM(ease_of_use_range) / count(ease_of_use_range) AS ease_of_use_rate'),
            DB::raw('SUM(support_range) / count(support_range) AS support_rate'),
            DB::raw('SUM(value_for_money_range) / count(value_for_money_range) AS value_for_money_rate'),
            DB::raw('SUM(verification_range) / count(verification_range) AS verification_rate'),
        );
    }
}
