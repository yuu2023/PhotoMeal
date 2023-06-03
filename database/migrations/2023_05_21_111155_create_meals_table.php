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
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('shop_id')->nullable();
            $table->string('title', 20);
            $table->text('introduction', 500)->nullable();
            $table->string('photo')->nullable();
            $table->date('ate_date')->nullable();
            $table->enum('visibility', ['public', 'friends', 'private'])->default('private');
            $table->boolean('can_others_use')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
