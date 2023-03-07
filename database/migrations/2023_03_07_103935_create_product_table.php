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
        Schema::create('product', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->String('reference')->unique();
            $table->String('description')->unique();
            $table->String('category')->nullable();
            $table->String('brand')->nullable();
            $table->unsigneddecimal('sale_price',10,2);
            $table->unsigneddecimal('purchase_price');
            $table->unsignedTinyInteger('vendor_id');
            $table->unsignedTinyInteger('vat_id');
            $table->timestamps();
            $table->foreign('vat_id')->references('id')->on('vat');
            $table->foreign('vendor_id')->references('id')->on('vendor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
