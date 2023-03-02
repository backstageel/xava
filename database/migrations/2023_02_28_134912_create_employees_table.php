<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_code')->nullable();
            $table->unsignedInteger('person_id');
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->unsignedTinyInteger('employee_position_id');
            $table->unsignedInteger('department_id');
            $table->date('start_date');
            $table->decimal('salary',10,2);
            $table->unsignedTinyInteger('employee_type_id');

            //Contas Bancarias, Bancos, Documentos Fiscais, Contratos de Trabalho,
            // Empregos anteriores, funcoes desempenhadas, duracao, motivo de saida
            //Certificações e treinamentos: Certificações, treinamentos e qualificações profissionais relevantes.
            //
            //Avaliações de desempenho: Avaliações de desempenho, metas alcançadas, pontos fortes e áreas a melhorar.
            //
            //Licenças e permissões: Licenças e permissões necessárias para realizar o trabalho (por exemplo, licença de condução).
            //
            //Benefícios e compensações: Informações sobre os benefícios oferecidos pela empresa, como seguro saúde, plano de aposentadoria, licença remunerada, bônus e outras compensações.
            //
            //Comunicações: Histórico de comunicações e feedbacks entre o funcionário e a empresa, como conversas sobre o desempenho, feedbacks e outras questões relacionadas ao trabalho.
            //
            //Informações de saída: Informações sobre a saída do funcionário, incluindo a data de término do contrato, o motivo da saída e as circunstâncias da saída.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
