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
        Schema::create('Situacao_Concuso', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_situacao_concuso')->primary();
            $table->string('nome', 45);
            $table->date('validade');
            $table->string('descricao', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Situacao_Concuso');
    }
};
