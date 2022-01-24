<?php

use App\Models\Exchanges\Exchange;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarketTypeToExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exchanges', function (Blueprint $table) {
            $table->enum('market_type', [Exchange::MARKET_TYPE_P2P, Exchange::MARKET_TYPE_OTC])->default(Exchange::MARKET_TYPE_P2P);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exchanges', function (Blueprint $table) {
            $table->drop('market_type');
        });
    }
}
