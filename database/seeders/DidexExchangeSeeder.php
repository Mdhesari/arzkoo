<?php

namespace Database\Seeders;

use App\Models\Currencies\Crypto;
use App\Models\Exchanges\Exchange;
use Exception;
use Illuminate\Database\Seeder;

class DidexExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchange = Exchange::firstOrCreate([
            'name' => 'didex',
        ], [
            'name' => 'didex',
            'title' => 'Didex',
            'persian_title' => 'دیدکس',
            'description' => 'صرافی دیدکس (didex)پل ارتباطی میان ایرانی‌ها با دنیای کریپتوکارنسی است. در شرایطی که به دلیل محدودیت‌های ناشی از تحریم، کاربران ایرانی با مشکلات مالیِ بین‌المللی روبرو هستند، پلتفرم معاملاتی رمزارزهای دیدکس، همه آن‌چه برای معامله و سرمایه‌گذاری در فضای ارزهای رمزنگاری‌‌شده لازم است را دارد. داشتن مجوز از اتحادیه اروپا، کسب مجوزهای قانونی در داخل ایران، امانت‌داری و حفظ امنیت مالی، استفاده از به‌روزترین شبکه، در نظر گرفتنِ کم‌ترین هزینه برای کاربران، تنوع در رمزارزها و خدمات و درنهایت بهره‌مندی از یک تیم حرفه‌ای در پشتیبانی، همگی ویژگی‌های صرافی دیدکس هستند که می‌تواند کاربران ایرانی را از هر پلتفرم معاملاتی دیگری بی‌نیاز کند.',
            'site' => 'https://didex.ir',
            'site_with_query' => 'https://didex.ir/auth/signup/credentials?referralCode=806161914',
            'physcial_address' => 'تهران، خیابان شهید بهشتی، خیابان سرافراز، کوچه هشتم، پلاک ۴',
            'status' => Exchange::STATUS_PUBLISHED,
            'contacts' => [
                'emails' => [
                    'support@didex.com',
                ],
                'mobiles' => [
                    '021-2842180',
                ],
            ],
        ]);

        $exchange_crypto = [];

        foreach ($supported = $this->adapter()->getSupported() as $symbol) {
            if (!$crypto = Crypto::whereSymbol(strtolower($symbol))->first()) {
                $symbolData = $this->coinMarketCap()->getSymbolMetaData([
                    'symbol' => $symbol,
                ])->recursive()->get('data')->get(strtoupper($symbol))->toArray();

                $crypto = Crypto::create([
                    'name' => $symbolData['name'],
                    'symbol' => $symbolData['symbol'],
                    'logo' => $symbolData['logo'],
                    'price' => 1,
                    'volume' => 1,
                    'market_cap' => 1,
                ]);
            }

            $exchange_crypto[$crypto->id] = [
                'buy_price' => 1,
                'sell_price' => 1,
                'currency' => 'irt',
            ];
        }

        $exchange->cryptos()->syncWithoutDetaching($exchange_crypto);
    }

    private function adapter()
    {
        return app('didex');
    }

    private function coinMarketCap()
    {
        return app('coinmarketcap');
    }
}
