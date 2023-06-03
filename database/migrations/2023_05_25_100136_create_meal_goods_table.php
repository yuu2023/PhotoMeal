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
        Schema::create('meal_goods', function (Blueprint $table) {
            $table->unsignedBigInteger('meal_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['meal_id', 'user_id']);
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_goods');
    }
};
