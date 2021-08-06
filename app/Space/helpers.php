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

    return numfmt_format_currency($fmt, $number, $currency);
}
