<?php

namespace App\Settings;

use App\Casts\StorageUrlCast;
use Spatie\LaravelSettings\Settings;
use Storage;

class GeneralSetting extends Settings
{
    public string $site_name;

    public string $site_description;

    public ?string $site_logo;

    public ?string $site_favicon;

    public static function group(): string
    {
        return 'general';
    }

    public function getFullUrl($value)
    {

        return Storage::url($value);
    }
}
