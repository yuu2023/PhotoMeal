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
        Schema::create('friends', function (Blueprint $table) {
            $table->unsignedBigInteger('friending_user_id');
            $table->unsignedBigInteger('friended_user_id');
            $table->primary(['friending_user_id', 'friended_user_id']);
            $table->foreign('friending_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friended_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
