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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('My Website');
            $table->string('light_logo')->nullable();
            $table->string('dark_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->json('contact_emails')->nullable();
            $table->json('contact_phones')->nullable();
            $table->text('map_iframe')->nullable();
            $table->text('footer_text')->nullable();
            $table->json('social_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
