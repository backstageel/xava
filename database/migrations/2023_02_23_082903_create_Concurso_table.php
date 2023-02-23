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
        Schema::create('Concurso', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_concurso');
            $table->string('nome', 45);
            $table->string('descricao', 45);
            $table->date('validade');
            $table->string('estado', 45);
            $table->integer('Cliente_id_cliente')->index('fk_Concurso_Cliente1_idx');
            $table->integer('Situacao_Concuso_id_situacao_concuso')->index('fk_Concurso_Situacao_Concuso1_idx');

            $table->primary(['id_concurso', 'Cliente_id_cliente', 'Situacao_Concuso_id_situacao_concuso']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Concurso');
    }
};
