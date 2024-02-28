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
        Schema::create('attendance', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('officer_id');
            // $table->unsignedBigInteger('college_id');
            $table->time('time');
            $table->integer('session');
            $table->integer('remarks');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('org_id')->references('org_id')->on('organizations')->onDelete('restrict');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('restrict');
            $table->foreign('officer_id')->references('id')->on('users')->onDelete('restrict');
            // $table->foreign('college_id')->references('id')->on('college')->onDelete('restrict');
            // $table->primary(['user_id','org_id','session','type']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
