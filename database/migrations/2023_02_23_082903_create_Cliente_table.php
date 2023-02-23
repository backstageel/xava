<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cliente', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_cliente')->primary();
            $table->string('nome', 45);
            $table->string('morada', 45);
            $table->string('pais', 45);
            $table->string('email', 45);
            $table->bigInteger('contacto1');
            $table->bigInteger('contacto2');
            $table->bigInteger('nuit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cliente');
    }
};
