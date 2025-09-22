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
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
             $table->string('nama_pelanggan');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('merek');
            $table->string('no_plat');
            $table->string('tanggal_booking');
            $table->string('tanggal_transaksi');
            $table->string('jenis_layanan');
            $table->string('layanan_tambahan');
            $table->string('item_terpilih');
            $table->integer('subtotal');
            $table->string('jasa');
            $table->integer('total');
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
