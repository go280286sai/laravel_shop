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
        Schema::create('user_descriptions', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('last_name', 200)->nullable();
            $table->bigInteger('gender_id')->unsigned();
            $table->date('birthday')->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('notes')->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_descriptions');
    }
};
