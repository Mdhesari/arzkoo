<?php

namespace App\Settings;

use App\Casts\StorageUrlCast;
use Spatie\LaravelSettings\Settings;
use Storage;

class LandingSetting extends Settings
{
    public array $categories;

    public static function group(): string
    {
        return 'landing';
    }
}
