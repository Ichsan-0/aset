<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lokasis')->insert([
            [
                'nama_lokasi' => 'Ruang TU',
                'gedung' => 'Gedung A',
                'lantai' => '1',
                'keterangan' => 'Tata Usaha',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Ruang Akademik',
                'gedung' => 'Gedung A',
                'lantai' => '2',
                'keterangan' => 'Layanan Akademik',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Ruang Kelas 101',
                'gedung' => 'Gedung B',
                'lantai' => '1',
                'keterangan' => 'Kelas Teori',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Ruang Prodi Informatika',
                'gedung' => 'Gedung A',
                'lantai' => '2',
                'keterangan' => 'Kantor Prodi',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lokasi' => 'Gudang',
                'gedung' => 'Gedung C',
                'lantai' => '1',
                'keterangan' => 'Penyimpanan',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
