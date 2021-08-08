<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->longText('comment')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('exchange_id')->constrained();
            $table->tinyInteger('ease_of_use_range');
            $table->tinyInteger('support_range');
            $table->tinyInteger('value_for_money_range');
            $table->tinyInteger('verification_range');
            $table->tinyInteger('average');
            $table->foreignId('rating_id')->nullable();
            $table->boolean('status')->default(false);

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
        Schema::dropIfExists('ratings');
    }
}
