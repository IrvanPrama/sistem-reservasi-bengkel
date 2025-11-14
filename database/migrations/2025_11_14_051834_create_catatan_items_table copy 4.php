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
        Schema::create('catatan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->constrained('catatans')->onDelete('cascade');
            $table->string('sub_type')->nullable();
            $table->string('category')->nullable();
            $table->string('note_title');
            $table->decimal('nominal', 15, 2)->default(0);
            $table->text('item_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_items');
    }
};
