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
        Schema::create('gender_descriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gender_id')->unsigned()->nullable();
            $table->bigInteger('language_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gender_descriptions');
    }
};
