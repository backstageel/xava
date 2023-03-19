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
        Schema::create('loans', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedInteger('employee_id');
            $table->decimal('amount');
            $table->integer('months')->nullable();
            $table->decimal('total_paid')->default(0);
            $table->decimal('installment');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');



            $table->foreign('employee_id')->references('id')->on('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
