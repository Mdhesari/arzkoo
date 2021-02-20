<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_features', function (Blueprint $table) {
            $table->id();

            $table->boolean('two_factor_auth');
            $table->boolean('app_android');
            $table->boolean('app_ios');
            $table->boolean('affiliate_support');
            $table->boolean('cold_storage');

            // tinyinteger : (0 no) to (1 average) (2 best)
            $table->tinyInteger('instant_verification');
            $table->tinyInteger('beginner_friendly');
            $table->tinyInteger('integrated_wallet');
            $table->tinyInteger('chat_support');

            $table->decimal('min_fee_percent');
            $table->decimal('max_fee_percent');
            $table->json('more_features');

            $table->foreignId('exchange_id')->constrained();

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
        Schema::dropIfExists('exchange_features');
    }
}
