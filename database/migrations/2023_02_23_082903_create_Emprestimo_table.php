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
        Schema::create('Emprestimo', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_emprestimo');
            $table->float('valor_emprestimo', 10, 0);
            $table->date('data_emprestimo');
            $table->integer('meses');
            $table->float('parcela', 10, 0);
            $table->float('valor_pago', 10, 0);
            $table->string('situacao', 45);
            $table->integer('Funcionario_id_funcionario')->index('fk_Emprestimo_Funcionario_idx');

            $table->primary(['id_emprestimo', 'Funcionario_id_funcionario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Emprestimo');
    }
};
