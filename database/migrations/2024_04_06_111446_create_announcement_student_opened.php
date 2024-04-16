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
        Schema::create('announcement_student_opened', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('announcement_id');
            $table->unsignedBigInteger('student_id');
            // $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('school_year');

            $table->foreign('announcement_id')->references('id')->on('announcement')->cascadeOnDelete();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnDelete();
            // $table->foreign('org_id')->references('org_id')->on('organizations')->cascadeOnDelete();
            $table->foreign('school_year')->references('id')->on('school_year')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement_student_opened');
    }
};
