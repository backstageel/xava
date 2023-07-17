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

        Schema::table('sale_items', function (Blueprint $table){

            $table->decimal('purchase_price', 20, 2)->nullable()->change();
            $table->decimal('quantity' )->nullable()->change();
            $table->decimal('total_purchase_price' , 20, 2)->default(0)->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('total_purchase_price', function (Blueprint $table) {
            //
        });
    }
};
