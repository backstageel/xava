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
        Schema::table('sales', function (Blueprint $table){



            $table->string('receipt_id')->nullable();
            $table->double('amount_received')->nullable();
            $table->double('transport_value')->nullable();
            $table->double('other_expenses')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('customer_name');

            $table->double('intermediary_committee')->nullable();
            $table->date('payment_date')->nullable();
            $table->double('profit')->nullable();
            $table->double('debt_amount')->nullable();


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
