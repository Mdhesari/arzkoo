<?php

namespace App\Models\Currencies;

use App\Models\Exchanges\Exchange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function exchanges()
    {
        return $this->belongsToMany(Exchange::class, 'exchange_crypto')->withPivot([
            'buy_price', 'sell_price', 'currency'
        ]);
    }

    public function bestExchange()
    {
        return $this->belongsToMany(Exchange::class, 'exchange_crypto')->withPivot([
            'buy_price', 'sell_price', 'currency'
        ])->orderByPivot('buy_price');
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
}
