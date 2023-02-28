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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('nuel')->unique();
            $table->date('date_registration');
            $table->unsignedInteger('republic_bulletin_id')->nullable();
            $table->unsignedTinyInteger('company_type_id');
            $table->decimal('share_capital',12,2);
            $table->string('address_avenue_id');
            $table->string('address_street_number');
            $table->string('address_neighborhood_id');
            $table->integer('address_district_id');
            $table->integer('address_province_id');
            $table->integer('address_country_id');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

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
        Schema::dropIfExists('companies');
    }
};
