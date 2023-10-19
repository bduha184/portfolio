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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('header_img_path')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->string('team_name');
            $table->string('introduction');
            $table->string('average')->nullable();
            $table->string('from_age')->nullable();
            $table->string('to_age')->nullable();
            $table->string('activities')->nullable();
            $table->string('schedule')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
