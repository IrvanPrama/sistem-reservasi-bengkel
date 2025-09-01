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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('id_reservation'); // Primary Key dengan nama id_reservation
            $table->string('customer_name');
            $table->unsignedBigInteger('field_id');
            $table->string('date'); // Menyimpan tanggal reservasi
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('total_amount', 10, 2)->default(0); // Total amount dengan default 0
            $table->string('doc_tf')->nullable(); // Menyimpan path file bukti transfer, nullable
            $table->string('status')->default('pending'); // Status reservasi dengan default 'pending'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
