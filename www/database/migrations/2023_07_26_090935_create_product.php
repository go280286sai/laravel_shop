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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('slug')->unique();
            $table->double('price')->default(0);
            $table->double('old_price')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('hit')->default(0);
            $table->string('img')->default('uploads/img/no-image.jpg');
            $table->integer('amount')->default(0);
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
