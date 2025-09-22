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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
             $table->string('id_booking');
            $table->string('nama_pelanggan');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('tanggal');
            $table->string('jam_kedatangan');
            $table->string('merek');
            $table->string('no_plat');
            $table->string('tahun');
            $table->string('layanan');
            $table->string('keterangan');
            $table->string('estimasi_waktu');
            $table->integer('estimasi_biaya');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
