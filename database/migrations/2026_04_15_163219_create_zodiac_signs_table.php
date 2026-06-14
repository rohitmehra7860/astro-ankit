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
        Schema::create('zodiac_signs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Aries, Taurus
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('image_url')->nullable();
            $table->string('date_range')->nullable(); // March 21 - April 19
            $table->string('meta_tags')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zodiac_signs');
    }
};
