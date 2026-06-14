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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique coupon code
            $table->enum('type', ['fixed', 'percentage']); // Discount type
            $table->decimal('discount_value', 10, 2); // Amount or percentage
            $table->decimal('minimum_order_amount', 10, 2)->nullable(); // Min order required
            $table->integer('usage_limit')->nullable(); // Max times it can be used
            $table->integer('used')->default(0); // Track how many times used
            $table->date('expires_at')->nullable(); // Expiry date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
