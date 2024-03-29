<?php

namespace App\Models;

use BeyondCode\Comments\Traits\CanComment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable, SoftDeletes, CanComment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value)
    {
        return $value ?: 'vaUu3Z652eyYjhW3Jd3DBlcozhJ3Ux1WB8Ri6rDP.png';
    }

    public function getFullImageAttribute()
    {
        return Storage::url($this->image);
    }

    public function hasPassword()
    {
        return !empty($this->password);
    }

    public function save(array $options = [])
    {
        if (is_null($this->name)) {
            $this->name = __(' No Name ');
        }

        if (is_null($this->password)) {
            $this->password = '';
        }

        return parent::save();
    }

    public function sendNewsLetterNotification()
    {

    }
}
