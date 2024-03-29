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
            $table->float('rate_avg')->default(0);
            $table->float('ease_of_use_avg')->default(0);
            $table->float('support_avg')->default(0);
            $table->float('value_for_money_avg')->default(0);
            $table->float('verification_avg')->default(0);

            $table->boolean('two_factor_auth')->default(false);
            $table->boolean('app_android')->default(false);
            $table->boolean('app_ios')->default(false);
            $table->boolean('affiliate_support')->default(false);
            $table->boolean('cold_storage')->default(false);
            $table->boolean('integrated_wallet')->default(false);

            $table->unsignedTinyInteger('verification_days')->default(3);

            $table->decimal('usdt_min_fee_percent')->nullable();
            $table->decimal('usdt_max_fee_percent')->nullable();
            $table->decimal('irr_min_fee_percent')->nullable();
            $table->decimal('irr_max_fee_percent')->nullable();
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
