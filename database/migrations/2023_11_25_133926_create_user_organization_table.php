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
        Schema::create('user_organization', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_org_id')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('school_year')->nullable();
            $table->unsignedBigInteger('year_level_id');
            // $table->unsignedBigInteger('college_id');
            $table->timestamps();
            $table->foreign('student_org_id')->references('org_id')->on('organizations');
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('school_year')->references('id')->on('school_year');
            // $table->foreign('college_id')->references('id')->on('college');
            $table->foreign('year_level_id')->references('id')->on('year_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_organization');
    }
};
