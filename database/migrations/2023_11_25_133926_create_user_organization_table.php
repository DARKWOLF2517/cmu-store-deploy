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
            $table->unsignedBigInteger('student_org_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('year_level_id');
            $table->unsignedBigInteger('school_year');
            $table->timestamps();
            $table->foreign('student_org_id')->references('org_id')->on('organizations');
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->foreign('year_level_id')->references('id')->on('year_level');
            $table->foreign('school_year')->references('id')->on('school_year');

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
