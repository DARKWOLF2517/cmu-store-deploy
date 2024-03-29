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
        Schema::create('free_fines_student', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->string('reason');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('school_year');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('org_id')->references('org_id')->on('organizations')->cascadeOnDelete();
            $table->foreign('school_year')->references('id')->on('school_year')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_fines_student');
    }
};
