<?php

namespace App\Models\Currencies;

use App\Models\Exchanges\Exchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Crypto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    private $isBuy = false;

    protected $casts = [
        'image' => 'string',
    ];

    protected $appends = [
        'logo_full_url',
    ];

    public function getLogoFullUrlAttribute()
    {
        if (!$this->logo) return '';

        if (isset(parse_url($this->logo)['scheme'])) {
            return $this->logo;
        }

        return asset(Storage::url($this->logo));
    }

    public function getSymbolAttribute($value)
    {
        return strtolower($value);
    }

    public function getIconAttribute($value)
    {
        return $value;
    }

    public function exchanges()
    {
        return $this->belongsToMany(Exchange::class, 'exchange_crypto')->withPivot([
            'buy_price', 'sell_price', 'currency'
        ]);
    }

    public function bestBuyExchange()
    {
        return $this->belongsToMany(Exchange::class, 'exchange_crypto')->published()->withPivot([
            'buy_price', 'sell_price', 'currency'
        ])->orderByPivot('buy_price', 'DESC');
    }

    public function bestSellExchange()
    {
        return $this->belongsToMany(Exchange::class, 'exchange_crypto')->published()->withPivot([
            'buy_price', 'sell_price', 'currency'
        ])->orderByPivot('sell_price', 'ASC');
    }

    private function getNumberAndCurrency($number, $currency, $forceIRR = false)
    {
        if ($forceIRR && $currency == 'USDT') {
            $number *= config('app.USDT_TO_IRR');
            $currency = 'IRR';
        }

        return arzkoo_money($number, $currency);
    }

    public function getPivotSellPriceFormattedAttribute()
    {
        return $this->getNumberAndCurrency($this->pivot->sell_price, $this->pivot->currency);
    }

    public function getPivotBuyPriceFormattedAttribute()
    {
        return $this->getNumberAndCurrency($this->pivot->buy_price, $this->pivot->currency);
    }

    public function storeExchanges(array $exchanges)
    {
        $data = [];

        foreach ($exchanges as $exch) {
            $exchange = Exchange::firstOrCreate([
                'name' => $exch['title'],
            ], Exchange::createData($exch));

            $data[$exchange->id] = [
                'buy_price' => Exchange::getPrice($exch['buy_price']),
                'sell_price' => Exchange::getPrice($exch['sell_price']),
                'currency' => $exch['pair']
            ];
        }

        $this->exchanges()->syncWithoutDetaching($data);
    }

    public static function storeAndGetCryptoLogoPath($logo_url)
    {
        $data = pathinfo($logo_url);

        download_image(storage_path('app/public/' . $path = 'symbols/' . $data['basename']), $logo_url);

        return $path;
    }

    /**
     * @return mixed
     */
    public function getIsBuy()
    {
        return $this->isBuy;
    }

    /**
     * @param mixed $isBuy
     */
    public function setIsBuy($isBuy)
    {
        $this->isBuy = $isBuy;

        return $this;
    }
}
