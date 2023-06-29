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
            $table->unsignedBigInteger('competition_result_id')->nullable();
            $table->foreign('competition_result_id')->references('id')->on('competition_results');
    });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
