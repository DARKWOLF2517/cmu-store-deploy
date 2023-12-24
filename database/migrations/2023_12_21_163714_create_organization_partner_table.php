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
        Schema::create('organization_partner', function (Blueprint $table) {
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('partner_org_id');
            $table->foreign('org_id')->references('org_id')->on('organizations')->cascadeOnDelete();
            $table->foreign('partner_org_id')->references('org_id')->on('organizations')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_partner');
    }
};
