<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\database\migrations\people;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedInteger('person_id');
            $table->string('status');
            $table->Integer('nuit');
            $table->unsignedTinyInteger('customer_type_id');

            $table->foreign('customer_type_id')->references('id')->on('customer_types');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custumers');
    }
};
