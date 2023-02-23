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
        Schema::create('Proposta', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_proposta');
            $table->integer('qtd');
            $table->float('preco_total', 10, 0);
            $table->date('validade');
            $table->integer('Cliente_id_cliente')->index('fk_Proposta_Cliente1_idx');
            $table->integer('Artigo_id_artigo');
            $table->integer('Artigo_Iva_id_iva');
            $table->integer('Utilizador_id_utilizador');
            $table->integer('Utilizador_Funcionario_id_funcionario');

            $table->index(['Artigo_id_artigo', 'Artigo_Iva_id_iva'], 'fk_Proposta_Artigo1_idx');
            $table->index(['Utilizador_id_utilizador', 'Utilizador_Funcionario_id_funcionario'], 'fk_Proposta_Utilizador1_idx');
            $table->primary(['id_proposta', 'Cliente_id_cliente', 'Artigo_id_artigo', 'Artigo_Iva_id_iva', 'Utilizador_id_utilizador', 'Utilizador_Funcionario_id_funcionario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Proposta');
    }
};
