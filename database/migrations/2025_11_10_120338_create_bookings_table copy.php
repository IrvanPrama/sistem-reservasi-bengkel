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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_antrian')->unique()->nullable();
            $table->string('nama_pelanggan');
            $table->string('no_telepon');
            $table->string('email');
            $table->string('alamat');
            $table->date('tanggal');
            $table->time('jam_kedatangan');
            $table->string('merek');
            $table->string('no_plat');
            $table->string('tahun');
            $table->text('keluhan');
            $table->text('keterangan')->nullable();
            $table->string('estimasi_waktu')->nullable();
            $table->decimal('estimasi_biaya', 15, 2)->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
