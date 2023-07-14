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

            $table->decimal('amount_received')->nullable()->change();
            $table->decimal('transport_value')->nullable()->change();
            $table->decimal('other_expenses')->nullable()->change();


            $table->decimal('intermediary_committee')->nullable()->change();

            $table->decimal('profit')->nullable()->change();
            $table->decimal('debt_amount')->nullable()->change();


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
