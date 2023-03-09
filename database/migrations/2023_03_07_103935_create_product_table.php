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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->String('reference')->unique()->nullable();
            $table->String('description')->unique()->nullable();
            $table->unsignedTinyInteger('category_id')->nullable();
            $table->String('brand')->nullable();
            $table->unsigneddecimal('sale_price',10,2);
            $table->unsigneddecimal('purchase_price')->nullable();
            $table->unsignedTinyInteger('vat_id')->nullable();
            $table->timestamps();
            $table->foreign('vat_id')->references('id')->on('vat');
          //  $table->foreign('category_id')->references('id')->on('product_categories');
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
