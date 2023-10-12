<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('event_state', function (Blueprint $table) {
            $table->foreignId('event_id');
            $table->foreignId('state_id');
            $table->primary(['event_id', 'state_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('states');
        Schema::dropIfExists('state_event');
    }
};
