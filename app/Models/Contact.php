<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'PENDING';
    const STATUS_READ = 'READ';
    const STATUS_CONTACT = 'CONTACT';

    protected $fillable = [
        'email', 'mobile', 'name', 'message'
    ];
}
