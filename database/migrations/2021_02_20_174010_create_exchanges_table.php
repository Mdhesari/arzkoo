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
            $table->string('logo')->nullable();
            $table->string('title', 64);
            $table->string('persian_title', 64)->nullable();
            $table->string('physcial_address')->nullable();
            $table->longText('description')->nullable();
            $table->string('site');
            $table->string('site_with_query')->nullable();
            $table->string('status')->default(Exchange::STATUS_PUBLISHED);
            $table->json('contacts')->nullable();

            $table->boolean('two_factor_auth')->default(false);
            $table->boolean('app_android')->default(false);
            $table->boolean('app_ios')->default(false);
            $table->boolean('affiliate_support')->default(false);
            $table->boolean('cold_storage')->default(false);
            $table->boolean('integrated_wallet')->default(false);

            // tinyinteger : (0 no) to (1 average) (2 best)
            $table->tinyInteger('instant_verification')->default(0);
            $table->tinyInteger('beginner_friendly')->default(0);
            $table->tinyInteger('chat_support')->default(0);

            $table->decimal('buy_price', 18, 2);
            $table->decimal('sell_price', 18, 2);
            $table->decimal('usdt_min_fee_percent');
            $table->decimal('usdt_max_fee_percent');
            $table->decimal('irr_min_fee_percent');
            $table->decimal('irr_max_fee_percent');
            $table->json('more_features')->nullable();

            $table->foreignId('admin_id')->nullable();

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
