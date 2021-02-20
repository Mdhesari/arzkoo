<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExchangeReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_exchange_reviews', function (Blueprint $table) {
            $table->id();

            $table->text('body');

            // tinyinteger : 0 to 5
            $table->unsignedTinyInteger('usability_rate');
            $table->unsignedTinyInteger('verification_rate');
            $table->unsignedTinyInteger('price_rate');
            $table->unsignedTinyInteger('support_rate');

            $table->foreignId('user_id')->nullable();
            $table->foreignId('exchange_id')->constrained();
            $table->foreignId('crypto_id')->constrained();

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
        Schema::dropIfExists('user_exchange_reviews');
    }
}
