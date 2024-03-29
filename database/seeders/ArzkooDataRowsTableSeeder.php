<?php

namespace Database\Seeders;

use App\Space\DataRows\CommentDataRows;
use App\Space\DataRows\ContactDataRows;
use App\Space\DataRows\CryptoDataRows;
use App\Space\DataRows\ExchangeDataRows;
use Illuminate\Database\Seeder;
use Illuminate\Pipeline\Pipeline;
use TCG\Voyager\Models\DataType;

class ArzkooDataRowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groupDataType = DataType::query();

        app(Pipeline::class)->send($groupDataType)->through([
            ExchangeDataRows::class,
            CryptoDataRows::class,
            ContactDataRows::class,
            CommentDataRows::class,
        ])
            ->via('create')
            ->then(function ($groupDataType) {
                return $groupDataType;
            });
    }
}
