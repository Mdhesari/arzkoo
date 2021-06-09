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

            $table->boolean('two_factor_auth');
            $table->boolean('app_android');
            $table->boolean('app_ios');
            $table->boolean('affiliate_support');
            $table->boolean('cold_storage');
            $table->boolean('integrated_wallet');

            // tinyinteger : (0 no) to (1 average) (2 best)
            $table->tinyInteger('instant_verification');
            $table->tinyInteger('beginner_friendly');
            $table->tinyInteger('chat_support');

            $table->decimal('min_fee_percent');
            $table->decimal('max_fee_percent');
            $table->json('more_features')->nullable();

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
