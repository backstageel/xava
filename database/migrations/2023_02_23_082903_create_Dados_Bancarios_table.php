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
        Schema::create('Dados_Bancarios', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_db');
            $table->string('titular', 45);
            $table->bigInteger('nib');
            $table->bigInteger('nr_conta');
            $table->integer('Fornecedor_id_fornecedor')->index('fk_Dados_Bancarios_Fornecedor1_idx');

            $table->primary(['id_db', 'Fornecedor_id_fornecedor']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Dados_Bancarios');
    }
};
