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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang'); // Alamat Supplier
            $table->integer('kategori_id')->nullable();
            $table->integer('id_supplier')->nullable(); 
            $table->string('merk')->nullable(); 
            $table->integer('id_lokasi')->nullable()->default(6);
            $table->enum('status', ['y','n'])->default('y'); // 'y' untuk aktif, 'n' untuk tidak aktif
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->integer('urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
