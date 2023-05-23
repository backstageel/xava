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
        Schema::table('competitions', function (Blueprint $table){
        $table->unsignedTinyInteger('company_type_id')->nullable();
        $table->foreign('company_type_id')->references('id')->on('company_types');});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
