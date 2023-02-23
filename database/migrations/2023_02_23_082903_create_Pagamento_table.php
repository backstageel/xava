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
        Schema::create('Pagamento', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_pagamento');
            $table->float('valor_parcela', 10, 0);
            $table->date('data');
            $table->integer('Emprestimo_id_emprestimo');
            $table->integer('Emprestimo_Funcionario_id_funcionario');

            $table->index(['Emprestimo_id_emprestimo', 'Emprestimo_Funcionario_id_funcionario'], 'fk_Pagamento_Emprestimo1_idx');
            $table->primary(['id_pagamento', 'Emprestimo_id_emprestimo', 'Emprestimo_Funcionario_id_funcionario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Pagamento');
    }
};
