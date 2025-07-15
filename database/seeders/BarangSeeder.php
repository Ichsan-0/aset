<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('barangs')->insert([
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Laptop Lenovo ThinkPad',
                'kategori_id' => 1, // aset tetap
                'id_supplier' => 2,
                'merk' => 'Lenovo',
                'id_lokasi' => 6,
                'status' => 'y',
                'keterangan' => 'Laptop untuk keperluan kantor',
                'urutan' => 1,
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Tinta Printer Epson L3110',
                'kategori_id' => 2, // habis pakai
                'id_supplier' => 3,
                'merk' => 'Epson',
                'id_lokasi' => 6,
                'status' => 'y',
                'keterangan' => 'Printer untuk administrasi',
                'urutan' => 2,
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Proyektor BenQ',
                'kategori_id' => 1, // aset tetap
                'id_supplier' => 1,
                'merk' => 'BenQ',
                'id_lokasi' => 6,
                'status' => 'y',
                'keterangan' => 'Proyektor ruang meeting',
                'urutan' => 3,
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Meja Kantor',
                'kategori_id' => 1, // aset tetap
                'id_supplier' => 4,
                'merk' => 'Olympic',
                'id_lokasi' => 6,
                'status' => 'n',
                'keterangan' => 'Meja kayu untuk staf',
                'urutan' => 4,
            ],
            [
                'kode_barang' => 'BRG005',
                'nama_barang' => 'Kursi Ergonomis',
                'kategori_id' => 1, // aset tetap
                'id_supplier' => 4,
                'merk' => 'IKEA',
                'id_lokasi' => 6,
                'status' => 'y',
                'keterangan' => 'Kursi kerja ergonomis',
                'urutan' => 5,
            ],
        ]);
    }
}
