<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->unsigned();
            $table->bigInteger('field_id')->unsigned();
            $table->foreign('team_id')->references('id')
                ->on('teams')
                ->onDelete('cascade');
            $table->foreign('field_id')->references('id')
                ->on('fields')
                ->onDelete('cascade');
            $table->date('date');
            $table->time('hour');
            $table->time('experation');
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
        Schema::dropIfExists('reservations');
    }
};
