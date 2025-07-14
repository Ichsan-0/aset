<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori_barangs')->insert([
            [
                'nama_kategori' => 'Peralatan Kantor',
                'kode_kategori' => 'PK',
                'tipe_barang' => 1, // Aset Tetap',
                'status' => 'y',
                'ket' => 'Digunakan di ruang kantor',
                'urutan' => 1
            ],
            [
                'nama_kategori' => 'Alat Tulis Kantor',
                'kode_kategori' => 'ATK',
                'tipe_barang' => 2, // Persediaan / Habis Pakai',
                'status' => 'y',
                'ket' => 'Habis pakai',
                'urutan' => 2
            ],
            [
                'nama_kategori' => 'Perangkat Lunak',
                'kode_kategori' => 'SW',
                'tipe_barang' => 3, // Aset Tak Berwujud',
                'status' => 'y',
                'ket' => 'Lisensi software',
                'urutan' => 3
            ],
            [
                'nama_kategori' => 'Kendaraan Operasional',
                'kode_kategori' => 'KO',
                'tipe_barang' => 1, // Aset Tetap',
                'status' => 'y',
                'ket' => 'Mobil & motor operasional',
                'urutan' => 4
            ],
            [
                'nama_kategori' => 'Barang Modal Lainnya',
                'kode_kategori' => 'BM',
                'tipe_barang' => 4, // Barang Modal',
                'status' => 'n',
                'ket' => 'Barang modal sementara',
                'urutan' => 5
            ],
        ]);
    }
}
