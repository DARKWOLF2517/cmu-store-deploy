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
        Schema::create('evaluation_form', function (Blueprint $table) {
            $table->id();
            $table->string('evaluation_title');
            $table->longText('evaluation_description');
            $table->unsignedBigInteger('org_id');
            $table->tinyInteger('is_accept_feedback');
            $table->unsignedBigInteger('school_year');
            $table->timestamps();

            $table->foreign('org_id')->references('org_id')->on('organizations')->onDelete('cascade');
            $table->foreign('school_year')->references('id')->on('school_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_form');
    }
};
