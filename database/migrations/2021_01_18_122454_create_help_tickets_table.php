<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('help_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('ticket_priority_id')->constrained();
            $table->foreignId('ticket_department_id')->constrained();
            $table->foreignId('webinar_id');
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_open')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('help_tickets');
    }
}
