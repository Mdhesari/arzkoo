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
