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
        Schema::create('Funcionario', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_funcionario')->primary();
            $table->string('nome', 45);
            $table->date('data_nascimento');
            $table->char('genero', 1);
            $table->string('nr_bi', 15);
            $table->string('bairro', 45);
            $table->string('rua', 45)->nullable();
            $table->string('cidade', 45);
            $table->bigInteger('contacto1');
            $table->bigInteger('contacto2')->nullable();
            $table->string('categoria', 45);
            $table->float('ordenado', 10, 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Funcionario');
    }
};
