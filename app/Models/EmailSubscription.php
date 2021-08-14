<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSubscription extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'PENDING';
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_ABORTED = 'ABORTED';
    const STATUS_UNSUBSCRIBED = 'UNSUBSCRIBED';

    protected $fillable = ['name', 'email'];
}
