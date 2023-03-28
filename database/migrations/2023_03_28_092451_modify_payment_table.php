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
        Schema::table('payments', function (Blueprint $table){
            $table->dropColumn('payment_date');
            $table->unsignedTinyInteger('loan_id');
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->string('months');
            $table->string('status');



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
