<?php

namespace App\Models\Exchanges;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'title',
        'persian_title',
        'physcial_address',
        'description',
        'site',
        'site_with_query',
        'status',
        'contacts',
    ];

    protected $casts = [
        'logo' => 'array',
        'contacts' => 'array',
    ];

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_CLOSED = 'CLOSED';

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->admin_id && Auth::user()) {
            $this->admin_id = Auth::user()->getKey();
        }

        return parent::save();
    }
}
