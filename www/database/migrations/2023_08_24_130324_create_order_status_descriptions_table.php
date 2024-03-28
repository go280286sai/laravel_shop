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
        Schema::create('order_status_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('language_id')->unsigned();
            $table->bigInteger('order_status_id')->unsigned();
            $table->timestamps();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_descriptions');
    }
};
