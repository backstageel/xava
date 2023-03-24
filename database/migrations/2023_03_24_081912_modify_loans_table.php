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
       Schema::table('loans', function (Blueprint $table){
           $table->dropColumn('start_date');
           $table->dropColumn('end_date');

           $table->string('status')->default('Ativo')->change();
           $table->string('order_status')->default('Pendente de aprovacao');
           $table->string('start_month')->nullable();
           $table->string('end_month')->nullable();
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
