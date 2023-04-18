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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('competition_month');
            $table->string('competition_number');
            $table->string('institution_type');
            $table->string('competition_type');
            $table->string('institution_name');
            $table->string('competition_reference');
            $table->string('nature')->nullable();
            $table->string('product_type')->nullable();
            $table->unsignedFloat('provisional_bank_guarantee')->nullable();
            $table->unsignedFloat('provisional_bank_guarantee_award')->nullable();
            $table->unsignedFloat('definitive_guarantee')->nullable();
            $table->unsignedFloat('definitive_guarantee_award')->nullable();
            $table->unsignedFloat('advance_guarantee')->nullable();
            $table->unsignedFloat('advance_guarantee_award')->nullable();
            $table->date('proposal_delivery_date')->nullable();
            $table->string('proposal_delivery_time')->nullable();
            $table->unsignedFloat('bidding_documents_value')->nullable();
            $table->string('reason')->nullable();
            $table->string('to_do')->nullable();
            $table->unsignedFloat('proposal_value')->nullable();
            $table->string('responsible')->nullable();
            $table->string('technical_proposal_review')->nullable();
            $table->string('documentary_review')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
