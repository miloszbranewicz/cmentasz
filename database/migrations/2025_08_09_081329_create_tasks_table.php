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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('reward');
            $table->integer('max_winners');
            $table->unsignedBigInteger('league_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', \App\TaskStatus::cases())->default(\App\TaskStatus::PENDING);
            $table->timestamps();

            $table->foreign('league_id')->references('id')->on('leagues');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
