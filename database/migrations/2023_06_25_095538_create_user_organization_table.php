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
            $table->unsignedBigInteger('student_org_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('role_id');
            $table->string('year_level');
            $table->timestamps();
            $table->foreign('student_org_id')->references('org_id')->on('organizations');
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('role_id')->references('role_id')->on('roles');
            
            $table->primary(['student_org_id','student_id','role_id']);
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
