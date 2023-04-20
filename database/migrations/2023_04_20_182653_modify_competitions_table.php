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
        Schema::table('competitions', function (Blueprint $table){
            $table->dateTime('proposal_delivery_date')->change();
            $table->dropColumn('proposal_delivery_time');
            $table->dropColumn('nature');
            $table->unsignedBigInteger('product_category_id');




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
