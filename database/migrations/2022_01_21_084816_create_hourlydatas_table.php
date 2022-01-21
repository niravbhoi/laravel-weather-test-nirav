<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourlydatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourlydatas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id');
            $table->string('timezone')->nullable();
            $table->bigInteger('timezone_offset')->nullable();
            $table->bigInteger('dt')->nullable();
            $table->bigInteger('sunrise')->nullable();
            $table->bigInteger('sunset')->nullable();
            $table->double('temp')->nullable();
            $table->double('feels_like')->nullable();
            $table->integer('pressure')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('uvi')->nullable();
            $table->integer('clouds')->nullable();
            $table->integer('visibility')->nullable();
            $table->double('wind_speed')->nullable();
            $table->double('wind_deg')->nullable();
            $table->double('wind_gust')->nullable();
            $table->string('weather_title')->nullable();
            $table->string('weather_description')->nullable();
            $table->string('weather_icon')->nullable();
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
        Schema::dropIfExists('hourlydatas');
    }
}
