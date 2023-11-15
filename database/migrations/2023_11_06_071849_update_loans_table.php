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
            $table->date('response_date')->nullable();
            $table->string('order_status')->default('Pendente')->change();
            $table->unsignedInteger('responsible_id')->nullable();
            $table->string('reason')->nullable();
            $table->string('internal_reference')->nullable();

            $table->foreign('responsible_id')->references('id')->on('users');

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
