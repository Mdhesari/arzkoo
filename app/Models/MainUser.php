<?php

namespace App\Models;

use App\Models\Payment\Discount;
use App\Models\Payment\Payment;
use App\Casts\CustomDateCast;
use App\Models\Webinar\Webinar;
use App\Space\Contracts\HasOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Modules\Main\Database\Factories\UserFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Storage;

class MainUser extends User implements HasMedia, HasOption
{
    use HasFactory,
        Notifiable,
        LogsActivity,
        InteractsWithMedia;

    protected $logFillables = true;

    protected static $logName = 'User';

    protected $casts = [

        'email_verified_at' => CustomDateCast::class,

        'mobile_verified_at' => CustomDateCast::class,

        'created_at' => CustomDateCast::class,

        'updated_at' => CustomDateCast::class,

    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = "users";

    public function getOptionValue(): string
    {
        return $this->id;
    }

    public function getOptionText(): string
    {
        return $this->name . " | " . $this->mobile . " | " . $this->id;
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {

        return is_null($value) ? asset('image/user.png') : Storage::url($value);
    }

    protected $appends = ['key'];

    public function getKeyAttribute()
    {
        return 'name';
    }
    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getMobileVerificationStatus()
    {

        return $this->mobile_verified_at ? __(' Active ') : __(' Pending ');
    }
    //-----------------Relations------------------//
    public function getInfoAttribute($value)
    {

        return $this->name . ' | ' . $this->mobile;
    }

    public function helpTickets()
    {

        return $this->hasMany(HelpTicket::class);
    }
}
