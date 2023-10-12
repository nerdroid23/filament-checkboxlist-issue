<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('city_event', function (Blueprint $table) {
            $table->foreignId('city_id');
            $table->foreignId('event_id');
            $table->primary(['city_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
        Schema::dropIfExists('city_event');
    }
};
