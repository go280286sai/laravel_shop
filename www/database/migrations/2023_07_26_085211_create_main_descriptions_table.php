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
        Schema::create('main_descriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('main_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->string('title');
            $table->timestamps();
            $table->foreign('main_id')->references('id')->on('mains')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_descriptions');
    }
};
