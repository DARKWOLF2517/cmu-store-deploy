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
        Schema::create('organization_accountabilities', function (Blueprint $table) {
            $table->id('accountability_id');
            $table->unsignedBigInteger('org_id');
            $table->string('accountability_name');
            $table->double('amount');
            $table->timestamps();
            $table->foreign('org_id')->references('org_id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_accountabilities');
    }
};
