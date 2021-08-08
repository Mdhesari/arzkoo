<?php

namespace App\Models\Exchanges;

use App\Models\Currencies\Crypto;
use App\Models\Rating;
use Auth;
use DB;
use Doctrine\DBAL\Types\FloatType;
use finfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'contacts' => 'array',
    ];

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_PUBLISHED = 'PUBLISHED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_CLOSED = 'CLOSED';

    const OPTION_VALUE_NULL = 'NULL';
    const OPTION_VALUE_AVG = 'AVG';
    const OPTION_VALUE_BEST = 'BEST';

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function calcAverageRate()
    {
        $ratings = $this->ratings()->cursor();

        $results = [];
        foreach ($ratings as $rating) {
            $results[] = ($rating->ease_of_use_range + $rating->support_range + $rating->value_for_money_range + $rating->verification_range) / 4;
        }

        info(array_sum($results));
        $ratingsCount = $this->ratings()->count();

        $total = $ratingsCount > 0 ? array_sum($results) / $ratingsCount : 0;

        $this->forceFill([
            'rate_avg' => $total
        ])->save();
    }

    public function getIRRSellPriceFormattedAttribute()
    {
        $currency = $this->pivot->currency;
        $number = $this->pivot->sell_price;

        return $this->getNumberAndCurrency($number, $currency, true);
    }

    public function getIRRBuyPriceFormattedAttribute()
    {
        $currency = $this->pivot->currency;
        $number = $this->pivot->buy_price;

        return $this->getNumberAndCurrency($number, $currency, true);
    }

    private function getNumberAndCurrency($number, $currency, $forceIRR = false)
    {
        if ($forceIRR && $currency == 'USDT') {
            $number *= config('app.USDT_TO_IRR');
            $currency = 'IRR';
        }

        return arzkoo_money($number, $currency);
    }

    public function getBestAmountDiffPercent($currentAmount, $bestAmount)
    {
        $percent = $currentAmount - $bestAmount;
        $percent = $percent / $bestAmount * 100;
        return round($percent);
    }

    public function getSellPriceFormattedAttribute()
    {
        return $this->getNumberAndCurrency($this->pivot->sell_price, $this->pivot->currency);
    }

    public function getBuyPriceFormattedAttribute()
    {
        return $this->getNumberAndCurrency($this->pivot->buy_price, $this->pivot->currency);
    }

    public function cryptos()
    {
        return $this->belongsToMany(Crypto::class, 'exchange_crypto')->withPivot([
            'buy_price', 'sell_price', 'currency'
        ]);
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
            'logo' => static::storeAndGetExchangeLogoPath($exchange['logo'])
        ], static::getFeesFields($exchange));
    }

    public function getRouteKeyName()
    {
        return 'title';
    }

    public static function getPrice($amount)
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
