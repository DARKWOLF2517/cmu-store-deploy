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
        Schema::create('waive_fee_events', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('waive_fee_id');
            $table->timestamps();

            $table->foreign('event_id')->references('event_id')->on('events')->cascadeOnDelete();
            $table->foreign('waive_fee_id')->references('id')->on('waive_fees')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waive_fee_events');
    }
};
