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
        Schema::create('kategori_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kategori');
            $table->string('nama_kategori');
            $table->enum('tipe_barang', ['A', 'B', 'C']); // Ganti opsi enum sesuai kebutuhan
            $table->text('ket')->nullable();
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->integer('urutan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_barangs');
    }
};
