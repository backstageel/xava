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
        Schema::create('Requisicao_Fornecedor_has_Artigo', function (Blueprint $table) {
            $table->comment('');
            $table->integer('Requisicao_Fornecedor_id_requisicao')->index('fk_Requisicao_Fornecedor_has_Artigo_Requisicao_Fornecedor1_idx');
            $table->integer('Artigo_id_artigo')->index('fk_Requisicao_Fornecedor_has_Artigo_Artigo1_idx');

            $table->primary(['Requisicao_Fornecedor_id_requisicao', 'Artigo_id_artigo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Requisicao_Fornecedor_has_Artigo');
    }
};
