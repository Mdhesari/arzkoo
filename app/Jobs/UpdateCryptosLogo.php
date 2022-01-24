<?php

namespace App\Jobs;

use App\Models\Currencies\Crypto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class UpdateCryptosLogo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->coinmarketcap()->getSymbolMetaData([
            'symbol' => strtolower(join(',', Crypto::whereNotIn('symbol', [
                'XDCE',
            ])->pluck('symbol')->toArray())),
        ])->recursive()->get('data')->map(function ($crypto) {
            Crypto::whereSymbol($crypto->get('symbol'))->update([
                'logo' => Crypto::storeAndGetCryptoLogoPath($crypto->get('logo'))
            ]);
        });
    }

    public function coinmarketcap()
    {
        return app('coinmarketcap');
    }
}
