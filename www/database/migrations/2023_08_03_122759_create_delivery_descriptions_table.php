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
        Schema::create('delivery_descriptions', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('delivery_id')->unsigned();
            $table->bigInteger('language_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_descriptions');
    }
};
