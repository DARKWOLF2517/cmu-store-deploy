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
        Schema::create('paid_accountabilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('student_org_id');
            $table->double('amount');
            $table->unsignedBigInteger('school_year');
            $table->string('accountability_type');
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('student_org_id')->references('org_id')->on('organizations');
            $table->foreign('school_year')->references('id')->on('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paid_accountabilities');
    }
};
