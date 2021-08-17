<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeCryptoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_crypto', function (Blueprint $table) {
            $table->foreignId('exchange_id');
            $table->foreignId('crypto_id');

            $table->float('buy_price', null, null);
            $table->float('sell_price', null, null);

            $table->string('currency')->default('IRR');

            $table->primary(['exchange_id', 'crypto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_crypto');
    }
}
