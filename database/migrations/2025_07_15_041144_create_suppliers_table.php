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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier'); // Nama Supplier
            $table->string('alamat')->nullable(); // Alamat Supplier
            $table->string('telepon')->nullable(); // Nomor Telepon
            $table->string('email')->nullable(); // Email Supplier
            $table->string('pic')->nullable(); 
            $table->string('kode_supplier')->unique(); // Kode Unik Supplier
            $table->text('keterangan')->nullable(); // Keterangan tambahan
            $table->enum('status', ['y','n'])->default('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
