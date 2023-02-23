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
        Schema::create('Doc_Admin', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id_doc_admin')->primary();
            $table->string('titulo', 45);
            $table->string('descricao', 45);
            $table->date('data');
            $table->string('tipo', 45);
            $table->string('path', 45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Doc_Admin');
    }
};
