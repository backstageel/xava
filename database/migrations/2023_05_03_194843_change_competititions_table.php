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
        Schema::table('competitions', function (Blueprint $table){
            $table->date('competition_date')->nullable();
            $table->dropColumn('institution_type');
            $table->dropColumn('competition_type');
            $table->dropColumn('institution_name');
            $table->unsignedInteger('customer_id');
            $table->renameColumn('competition_number','internal_reference');
            $table->string('competition_reference')->nullable()->change();
            $table->dropColumn('nature');
            $table->unsignedTinyInteger('product_category_id');
            $table->unsignedInteger('product_id');
            $table->dropColumn('product_type');
            $table->string('provisional_bank_guarantee')->nullable()->change();
            $table->string('provisional_bank_guarantee_award')->nullable()->change();
            $table->string('definitive_guarantee')->nullable()->change();
            $table->string('definitive_guarantee_award')->nullable()->change();
            $table->string('advance_guarantee')->nullable()->change();
            $table->string('advance_guarantee_award')->nullable()->change();
            $table->string('bidding_documents_value')->nullable()->change();
            $table->dropColumn('reason');
            $table->dropColumn('to_do');
            $table->unsignedTinyInteger('competition_reason_id');
            $table->unsignedTinyInteger('competition_status_id');
            $table->unsignedTinyInteger('competition_type_id');
            $table->unsignedInteger('employee_responsible_id')->nullable();
            $table->unsignedInteger('employee_technical_review_id')->nullable();
            $table->unsignedInteger('employee_document_review_id')->nullable();
            $table->string('proposal_value')->nullable()->change();



        });
    }

};
