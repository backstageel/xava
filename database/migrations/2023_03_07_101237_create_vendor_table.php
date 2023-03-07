<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->String('name')->unique();
            $table->String('email')->unique()->nullable();
            $table->String('web')->unique()->nullable();
            $table->unsignedTinyInteger('country_id');
            $table->unsignedInteger('province_id');
            $table->unsignedInteger('district_id')->nullable();
            $table->String('address')->nullable();
            //numero único de identificação tributaria
            $table->String('utin_code')->unique();
            $table->bigInteger('phone_number_1')->unique();
            $table->bigInteger('phone_number_2')->unique()->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor');
    }
};
