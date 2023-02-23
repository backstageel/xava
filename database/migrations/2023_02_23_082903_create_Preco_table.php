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
        Schema::create('Preco', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_preco');
            $table->string('preco', 45);
            $table->integer('Artigo_id_artigo')->index('fk_Preco_Artigo1_idx');
            $table->integer('Fornecedor_id_fornecedor')->index('fk_Preco_Fornecedor1_idx');

            $table->primary(['id_preco', 'Artigo_id_artigo', 'Fornecedor_id_fornecedor']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Preco');
    }
};
