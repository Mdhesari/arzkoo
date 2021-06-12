<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptos', function (Blueprint $table) {
            $table->id();

            $table->string('symbol', 8);
            $table->string('name', 32);
            $table->json('image')->nullable();
            $table->decimal('price', 18, 2);
            $table->unsignedBigInteger('volume');
            $table->unsignedBigInteger('market_cap');
            $table->string('currency', 8)->default('USD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cryptos');
    }
}
