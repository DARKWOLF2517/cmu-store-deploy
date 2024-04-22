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
        Schema::create('event_cancelled_attendance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->integer('session');
            $table->unsignedBigInteger('school_year');
            $table->unsignedBigInteger('org_id');

            $table->timestamps();

            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->foreign('school_year')->references('id')->on('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_exempted_attendance');
    }
};
