<?php

namespace App\Models;

use App\Notifications\VerifyNewsLetter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailSubscription extends Model
{
    use HasFactory, Notifiable;

    const STATUS_PENDING = 'PENDING';
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_ABORTED = 'ABORTED';
    const STATUS_UNSUBSCRIBED = 'UNSUBSCRIBED';

    protected $fillable = ['name', 'email'];

    public function sendNewsLetterNotification()
    {
        $this->notify(new VerifyNewsLetter);
    }
}
