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
        Schema::create('fill_surveys', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('survey_id');
            $table->bigInteger('survey_question_id');
            $table->bigInteger('user_id');
            $table->string('name_user');
            $table->enum('fill_survey', ['Sangat Tidak', 'tidak', 'cukup', 'puas', 'Sangat Puas'])->default('cukup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_surveys');
    }
};
