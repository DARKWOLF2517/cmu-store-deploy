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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('name');
            $table->date('start_date');
            $table->time('start_attendance');
            $table->time('end_attendance');
            $table->string('location');
            $table->text('description');
            $table->tinyInteger('require_attendance');
            $table->integer('attendance_count')->default(1);
            $table->integer('attendance_session_started')->default(0);
            $table->boolean('evaluation_status')->default(0);
            $table->boolean('attendance_status')->default(0);
            $table->double('fines')->default(0);
            
            $table->unsignedBigInteger('school_year');
            $table->unsignedBigInteger('org_id');
            $table->foreign('school_year')->references('id')->on('school_year')->onDelete('cascade');
            $table->foreign('org_id')->references('org_id')->on('organizations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
