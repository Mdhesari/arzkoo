<?php

namespace App\Models\Exchanges;

use App\Models\Currencies\Crypto;
use Auth;
use finfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'buy_price' => 'float',
        'sell_price' => 'float',
        'contacts' => 'array',
    ];

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_CLOSED = 'CLOSED';

    const OPTION_VALUE_NULL = 'NULL';
    const OPTION_VALUE_AVG = 'AVG';
    const OPTION_VALUE_BEST = 'BEST';

    public function getSellPriceFormattedAttribute()
    {
        return number_format($this->sell_price) . ' تومان ';
    }

    public function getBuyPriceFormattedAttribute()
    {
        return number_format($this->buy_price) . ' تومان ';
    }

    public function cryptos()
    {
        return $this->belongsToMany(Crypto::class, 'exchange_crypto');
    }

    public function scopePublished($query)
    {
        return $query->whereStatus(static::STATUS_PUBLISHED);
    }

    public function isFeatured()
    {
        return false;
    }

    public function getFeaturesAttribute()
    {
        $features = [];

        $data = collect($this->toArray());

        $data = $data->filter(fn ($item) => $item === 0 || $item === 1);

        $features = $data->map(function ($item, $key) {
            return [
                'title' => __('exchanges.features.' . $key),
                'value' => $item
            ];
        });

        return $features;
    }

    public static function createData($exchange)
    {
        return array_merge([
            'name' => $exchange['title'],
            'title' => $exchange['exchange_title'],
            'persian_title' => $exchange['label'],
            'site' => optional(parse_url($exchange['site_with_source']))['host'],
            'site_with_query' => $exchange['site_with_source'],
            'buy_price' =>  static::getPrice($exchange['buy_price']),
            'sell_price' => static::getPrice($exchange['sell_price']),
            'logo' => static::storeAndGetExchangeLogoPath($exchange['logo'])
        ], static::getFeesFields($exchange));
    }

    public function getRouteKeyName()
    {
        return 'title';
    }

    private static function getPrice($amount)
    {
        return str_replace(",", "", $amount);
    }

    private static function storeAndGetExchangeLogoPath($logo)
    {
        if (!is_dir(public_path('assets/cryptos'))) {
            mkdir(public_path('assets/cryptos'));
        }

        $data = pathinfo($logo);

        $url = "https://tokenbaz.com" . $logo;

        file_put_contents(public_path($path = 'assets/cryptos/' . $data['basename']), file_get_contents($url));

        return $path;
    }

    private static function getFeesFields(array $exchange)
    {
        $irr_fee = $exchange['irr_fee'];
        $usdt_fee = $exchange['usdt_fee'];

        $irr_fee = explode('الی', $irr_fee);
        $usdt_fee = explode('الی', $usdt_fee);

        $data = [
            'usdt_min_fee_percent' => $usdt_fee[0],
            'usdt_max_fee_percent' => isset($usdt_fee[1]) ? $usdt_fee[1] : $usdt_fee[0],
            'irr_min_fee_percent' => $irr_fee[0],
            'irr_max_fee_percent' => isset($irr_fee[1]) ? $irr_fee[1] : $irr_fee[0],
        ];

        $data = array_map(function ($item) {
            return floatval(str_replace("%", " ", $item));
        }, $data);

        return $data;
    }

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->admin_id && Auth::user()) {
            $this->admin_id = Auth::user()->getKey();
        }

        return parent::save();
    }
}
