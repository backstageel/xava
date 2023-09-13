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
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->string('internal_reference');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('number_of_days')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('responsible_id')->nullable();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('vacation_statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('responsible_id')->references('id')->on('users');
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
