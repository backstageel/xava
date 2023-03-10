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
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('person_prefix_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedTinyInteger('gender_id');
            $table->date('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->unsignedInteger('address_district_id')->nullable();
            $table->unsignedBigInteger('address_province_id')->nullable();
            $table->unsignedInteger('address_country_id')->nullable();
            $table->unsignedInteger('birth_district_id')->nullable();
            $table->unsignedBigInteger('birth_province_id')->nullable();
            $table->unsignedInteger('birth_country_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('civil_state_id')->nullable();
            $table->string('nuit')->nullable();
            $table->unsignedTinyInteger('identity_document_type_id')->nullable();
            $table->string('identity_document_number')->nullable();
            $table->date('identity_document_emission_date')->nullable();
            $table->date('identity_document_expiry_date')->nullable();

            $table->foreign('gender_id')->references('id')->on('genders');

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
        Schema::dropIfExists('people');
    }
};
