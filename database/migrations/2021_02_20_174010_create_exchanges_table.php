<?php

use App\Models\Exchanges\Exchange;
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
            $table->json('logo')->nullable();
            $table->string('title', 64);
            $table->string('persian_title', 64)->nullable();
            $table->string('physcial_address');
            $table->text('description');
            $table->string('site');
            $table->string('site_with_query')->nullable();
            $table->string('status')->default(Exchange::STATUS_PUBLISHED);
            $table->json('contacts')->nullable();

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
