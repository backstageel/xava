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
        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->unsignedTinyInteger('contract_type_id');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->decimal('base_salary', 10, 2);
            $table->integer('weekly_hours')->nullable();
            $table->text('benefits')->nullable();
            $table->unsignedTinyInteger('contract_status_id')->default(1);
            $table->unsignedTinyInteger('employee_position_id');
            $table->unsignedInteger('department_id');
            $table->date('termination_date')->nullable();
            $table->text('termination_reason')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('contract_type_id')->references('id')->on('employee_contract_types');
            $table->foreign('contract_status_id')->references('id')->on('employee_contract_statuses');
            $table->foreign('employee_position_id')->references('id')->on('employee_positions');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_contracts');
    }
};
