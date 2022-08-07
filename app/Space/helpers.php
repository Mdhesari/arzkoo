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
    return 'key'.$username.':send_verification';
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

    $number = numfmt_format_currency($fmt, $number, $currency);

    if ( Str::contains($number, ['ریال', 'IRT', 'irt']) )
        return Str::of($number)->replace(['ریال', 'IRT', 'irt'], '') . ' تومان ';

    return $number;
}

function getRangeLabel($range)
{
    $label = 'null';

    if ( $range > 0 && $range < 3 )
        $label = 'avg';

    if ( $range > 0 && $range > 3 )
        $label = 'best';

    return __('seeders.data_rows.options.'.$label);
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

function get_top_cryptos(): array
{
    return Cache::rememberForever('topCryptos', function () {
        return collect(app('coinmarketcap')->getCryptos()->get('data'))->pluck('symbol')->toArray();
    });
}

//function get_fee($feeStr)
//{
//    return collect(explode('الی', $feeStr))->map(fn($item) => floatval(preg_replace('/([0-9]{1,3}(?:,[0-9]{3})*\.[0-9]+)/', '', $item)))->toArray();
//}

function download_image($filename, $url)
{
    if ( file_exists($filename) ) {
        @unlink($filename);
    }

    if ( ! is_dir(dirname($filename)) ) {
        mkdir(dirname($filename));
    }

    $fp = fopen($filename, 'w');
    if ( $fp ) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $result = parse_url($url);
        curl_setopt($ch, CURLOPT_REFERER, $result['scheme'].'://'.$result['host']);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0');
        $raw = curl_exec($ch);
        curl_close($ch);
        if ( $raw ) {
            fwrite($fp, $raw);
        }
        fclose($fp);
        if ( ! $raw ) {
            @unlink($filename);
            return false;
        }
        return true;
    }
    return false;
}

function get_usdt_to_irr()
{
    return Cache::remember('usdt-to-irt', now()->addHour(), function () {
        return app('nobitex')->getUSDTIRR();
    });
}
