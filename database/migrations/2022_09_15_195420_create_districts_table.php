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
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->unsignedInteger('province_id');
            $table->unsignedTinyInteger('country_id');
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unique(['name', 'province_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
};
