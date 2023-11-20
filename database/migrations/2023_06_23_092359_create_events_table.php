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
            $table->date('end_date');
            $table->time('start_attendance');
            $table->time('end_attendance');
            $table->string('location');
            $table->text('description');
            $table->tinyInteger('require_attendance');
            $table->integer('attendance_count')->default(1);
            $table->boolean('evaluation_status')->default(0);
            $table->boolean('attendance_status')->default(0);
            $table->double('fines')->nullable()->change();
            
            $table->unsignedBigInteger('org_id');
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
