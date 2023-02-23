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
        Schema::create('Requisicao_Fornecedor', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_requisicao');
            $table->integer('qtd');
            $table->float('preco_total', 10, 0)->nullable();
            $table->integer('Fornecedor_id_fornecedor')->index('fk_Requisicao_Fornecedor_Fornecedor1_idx');
            $table->integer('Utilizador_id_utilizador');
            $table->integer('Utilizador_Funcionario_id_funcionario');

            $table->index(['Utilizador_id_utilizador', 'Utilizador_Funcionario_id_funcionario'], 'fk_Requisicao_Fornecedor_Utilizador1_idx');
            $table->primary(['id_requisicao', 'Fornecedor_id_fornecedor', 'Utilizador_id_utilizador', 'Utilizador_Funcionario_id_funcionario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Requisicao_Fornecedor');
    }
};
