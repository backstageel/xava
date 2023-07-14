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
        Schema::table('sales', function (Blueprint $table) {

            $table->decimal('amount_received', 20, 2)->nullable()->change();
            $table->decimal('transport_value', 20, 2)->nullable()->change();
            $table->decimal('other_expenses', 20, 2)->nullable()->change();
            $table->decimal('total_amount', 20, 2)->nullable()->change();

            $table->decimal('intermediary_committee', 20, 2)->nullable()->change();

            $table->decimal('profit', 20, 2)->nullable()->change();
            $table->decimal('debt_amount',20, 2)->nullable()->change();


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
