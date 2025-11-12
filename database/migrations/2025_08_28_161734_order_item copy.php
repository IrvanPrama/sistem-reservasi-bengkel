<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->string('sku');
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('sell_price', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->integer('status')->default(0); // 0: pending, 1: accepted, 2: canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
