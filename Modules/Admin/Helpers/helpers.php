<?php

/**
 * Get url host
 *
 * @param  string $url
 * @return string
 */
function get_url_host($url)
{

    $url = parse_url($url);

    $host = optional($url)['host'];

    return $host;
}

/**
 * randomPassword
 *
 * @return string
 */
function random_password()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function convert_to_english_number($number)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $number);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    return $englishNumbersOnly;
}

function convert_to_persianNumber($number)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    // $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($num ,$persian, $number);
    // $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    return $convertedPersianNums;
}

function general_setting($key, $value = null)
{

    $setting = app(\App\Settings\GeneralSetting::class);

    if (is_null($value)) return $setting->toArray()[$key];

    return $setting->$key = $value;
}

function checkWebinarLesson($user, $webinar, $lesson)
{

    if ($user instanceof \Modules\Admin\Entities\Admin) return true;

    if ($webinar->ownsLesson($lesson)) return false;

    return $user->ownsWebinar($webinar);
}
