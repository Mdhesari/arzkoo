<?php

use Illuminate\Cache\RateLimiter;

function get_default_currency()
{
    return 'IRR';
}

function get_default_currency_symbol()
{
    return ' ریال ';
}

function make_mobile_limiter_key($username)
{
    return 'key' . $username . ':send_verification';
}

function get_available_in_rate_limiter(RateLimiter $limiter, $key)
{
    return now()->addSeconds($limiter->availableIn($key))->diffInSeconds();
}

function is_route($route)
{
    info(Route::current()->getName());
    return Route::current()->getName() == $route;
}

function arzkoo_money($number, $currency = 'IRR', $locale = 'fa_IR')
{
    $fmt = numfmt_create($locale, NumberFormatter::CURRENCY);

    return Str::of(numfmt_format_currency($fmt, $number, $currency))->replace(['ریال', 'IRT'], 'تومان');
}

function getRangeLabel($range)
{
    $label = 'null';

    if ($range > 0 && $range < 3)
        $label = 'avg';

    if ($range > 0 && $range > 3)
        $label = 'best';

    return __('seeders.data_rows.options.' . $label);
}

/**
 * @param $str
 */
function Persian_image(&$str)
{
    include_once(base_path('tools/libs/bidi.php'));

    $text = explode("\n", $str);

    $str = array();

    foreach ($text as $line) {
        $chars = app(bidi::class)->utf8Bidi(app(bidi::class)->UTF8StringToArray($line), 'R');
        $line = '';
        foreach ($chars as $char) {
            $line .= app(bidi::class)->unichr($char);
        }

        $str[] = $line;
    }

    $str = implode("\n", $str);

    return $str;
}

function get_top_coins()
{
    Cache::rememberForever('topCoins', function () {
        app('nobitex')->getTopCoins();
    });
}
