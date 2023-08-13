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
        Schema::create('expense_requests', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('transfer_account_number')->nullable();
            $table->float('amount')->nullable();
            $table->string('internal_reference')->nullable();
            $table->string('request_date')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('approval_status_id')->nullable();
            $table->unsignedBigInteger('request_status_id')->nullable();
            $table->unsignedBigInteger('accounting_status_id')->nullable();
            $table->unsignedBigInteger('transaction_account_id')->nullable();
            $table->unsignedInteger('approved_by_user_id')->nullable();
            $table->unsignedInteger('accountant_user_id')->nullable();
            $table->unsignedInteger('treasurer_user_id')->nullable();
            $table->unsignedInteger('requester_user_id')->nullable();
            $table->timestamps();

            $table->foreign('approval_status_id')->references('id')->on('approval_statuses');
            $table->foreign('type_id')->references('id')->on('expense_request_types');
            $table->foreign('request_status_id')->references('id')->on('request_statuses');
            $table->foreign('accounting_status_id')->references('id')->on('accounting_statuses');
            $table->foreign('transaction_account_id')->references('id')->on('transaction_accounts');
            $table->foreign('approved_by_user_id')->references('id')->on('users');
            $table->foreign('accountant_user_id')->references('id')->on('users');
            $table->foreign('treasurer_user_id')->references('id')->on('users');
            $table->foreign('requester_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_requests');
    }
};
