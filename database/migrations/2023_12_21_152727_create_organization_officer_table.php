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
        Schema::create('organization_officer', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('org_id');
            $table->string('position');
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('org_id')->references('org_id')->on('organizations')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_officer');
    }
};