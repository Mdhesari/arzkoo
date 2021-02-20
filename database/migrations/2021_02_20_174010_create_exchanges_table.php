<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();

            $table->string('name', 16);
            $table->string('logo')->nullable();
            $table->string('label', 16);
            $table->string('physcial_address');
            $table->text('description');
            $table->urldecode('site');
            $table->urlencode('site_with_query');
            $table->json('contacts');

            $table->foreignId('market_type_id');
            $table->foreignId('admin_id');

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
        Schema::dropIfExists('exchanges');
    }
}
