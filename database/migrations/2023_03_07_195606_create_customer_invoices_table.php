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
        Schema::create('customer_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->unsignedInteger('customer_id');
            $table->string('billing_address')->nullable();
            $table->string('shipping_address')->nullable();
            $table->decimal('total_amount', 8, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->date('due_date')->nullable();
            $table->string('payment_status')->default(2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_invoices');
    }
};
