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
        Schema::create('pop_tvs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview');
            $table->date('release_date');
            $table->string('genre')->nullable(); // Assuming genre can be nullable
            $table->string('backdrop_path')->nullable();
            $table->decimal('vote_average', 4, 2);
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
        Schema::dropIfExists('pop_tvs');
    }
};
