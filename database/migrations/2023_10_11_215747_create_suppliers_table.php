<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('city_supplier', function (Blueprint $table) {
            $table->foreignId('city_id');
            $table->foreignId('supplier_id');
            $table->primary(['city_id', 'supplier_id']);
        });

        Schema::create('event_supplier', function (Blueprint $table) {
            $table->foreignId('event_id');
            $table->foreignId('supplier_id');
            $table->primary(['event_id', 'supplier_id']);
        });

        Schema::create('state_supplier', function (Blueprint $table) {
            $table->foreignId('state_id');
            $table->foreignId('supplier_id');
            $table->primary(['state_id', 'supplier_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('city_supplier');
        Schema::dropIfExists('event_supplier');
        Schema::dropIfExists('state_supplier');
    }
};
