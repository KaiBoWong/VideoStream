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
        Schema::create('watch_histories', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('title')->nullable();
            $table->string('genre')->nullable(); // Assuming genre can be nullable
            $table->string('poster_path')->nullable();
            $table->string('media_type')->nullable();
            $table->unsignedBigInteger('tmdb_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_histories');
    }
};
