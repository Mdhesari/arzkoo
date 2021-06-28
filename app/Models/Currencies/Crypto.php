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
        return $this->belongsToMany(Exchange::class, 'exchange_crypto');
    }

    public function storeExchanges(array $exchanges)
    {
        $data = [];

        foreach ($exchanges as $exch) {
            $exchange = Exchange::firstOrCreate([
                'name' => $exch['title'],
            ], Exchange::createData($exch));

            $data[] = $exchange;
        }

        $data = collect($data);

        $this->exchanges()->syncWithoutDetaching($data->pluck('id'));
    }
}
