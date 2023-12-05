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
        Schema::create('toko', function (Blueprint $table) {
            $table->integer('kode_barang');
            $table->unique('kode_barang');
            $table->string('nama_barang');
            $table->string('gambar_barang');
            $table->decimal('harga_barang');
            $table->integer('stok_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko');
    }
};
