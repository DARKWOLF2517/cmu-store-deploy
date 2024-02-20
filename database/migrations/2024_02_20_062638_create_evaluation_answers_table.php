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
        Schema::create('evaluation_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_response_id');
            $table->unsignedBigInteger('question_id');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('evaluation_response_id')->references('id')->on('evaluation_response');
            $table->foreign('question_id')->references('id')->on('evaluation_questions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_answers');
    }
};
