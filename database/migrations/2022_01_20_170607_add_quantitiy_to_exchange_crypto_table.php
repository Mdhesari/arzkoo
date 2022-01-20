<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantitiyToExchangeCryptoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exchange_crypto', function (Blueprint $table) {
            $table->float('buy_quantity', null, null)->nullable();
            $table->float('sell_quantity', null, null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exchange_crypto', function (Blueprint $table) {
            //
        });
    }
}
