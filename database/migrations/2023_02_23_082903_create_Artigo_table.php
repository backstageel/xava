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
        Schema::create('Artigo', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_artigo');
            $table->string('descicao', 45);
            $table->string('categoria', 45);
            $table->string('subcategora', 45);
            $table->string('marca', 45);
            $table->string('estado', 20);
            $table->float('preco_venda', 10, 0)->nullable();
            $table->integer('Iva_id_iva')->index('fk_Artigo_Iva1_idx');
            $table->integer('Utilizador_id_utilizador');
            $table->integer('Utilizador_Funcionario_id_funcionario');

            $table->index(['Utilizador_id_utilizador', 'Utilizador_Funcionario_id_funcionario'], 'fk_Artigo_Utilizador1_idx');
            $table->primary(['id_artigo', 'Iva_id_iva', 'Utilizador_id_utilizador', 'Utilizador_Funcionario_id_funcionario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Artigo');
    }
};
