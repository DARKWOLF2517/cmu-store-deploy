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
        Schema::create('waive_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('reason');
            $table->string('accountability_type');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('school_year');
            // $table->unsignedBigInteger('event_id');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('org_id')->references('org_id')->on('organizations')->cascadeOnDelete();
            $table->foreign('school_year')->references('id')->on('school_year')->cascadeOnDelete();
            // $table->foreign('event_id')->references('event_id')->on('events')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waive_fees');
    }
};
