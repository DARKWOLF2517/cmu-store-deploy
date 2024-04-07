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
        Schema::create('evaluation_feedback_answer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('evaluation_form_id');
            $table->unsignedBigInteger('event_id');
            $table->longText('feedback');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('evaluation_form_id')->references('id')->on('evaluation_form')->onDelete('cascade');
            $table->foreign('event_id')->references('event_id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_feedback_answer');
    }
};
