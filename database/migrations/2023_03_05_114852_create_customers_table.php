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
            $table->increments('id');
            $table->unsignedTinyInteger('customer_status_id')->default(1);
            $table->unsignedTinyInteger('customer_type_id')->nullable();
            $table->unsignedInteger('customerable_id');
            $table->string('customerable_type');

            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->foreign('customer_status_id')->references('id')->on('customer_statuses');

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
