<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Supplierseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'nama_supplier' => 'PT Sumber Makmur',
                'alamat'        => 'Jl. Merdeka No. 10, Jakarta',
                'telepon'       => '0211234567',
                'email'         => 'info@sumbermakmur.co.id',
                'pic'           => 'Budi Santoso',
                'kode_supplier' => 'SUP001',
                'keterangan'    => 'Supplier alat tulis',
                'status'        => 'y',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_supplier' => 'CV Maju Jaya',
                'alamat'        => 'Jl. Sudirman No. 20, Bandung',
                'telepon'       => '0227654321',
                'email'         => 'majujaya@gmail.com',
                'pic'           => 'Siti Aminah',
                'kode_supplier' => 'SUP002',
                'keterangan'    => 'Supplier komputer',
                'status'        => 'y',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_supplier' => 'UD Sejahtera',
                'alamat'        => 'Jl. Diponegoro No. 5, Surabaya',
                'telepon'       => '0318765432',
                'email'         => 'sejahtera@ud.com',
                'pic'           => 'Andi Wijaya',
                'kode_supplier' => 'SUP003',
                'keterangan'    => 'Supplier furniture',
                'status'        => 'y',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_supplier' => 'PT Sentosa Abadi',
                'alamat'        => 'Jl. Gajah Mada No. 15, Semarang',
                'telepon'       => '0241239876',
                'email'         => 'sentosaabadi@pt.com',
                'pic'           => 'Rina Kusuma',
                'kode_supplier' => 'SUP004',
                'keterangan'    => 'Supplier elektronik',
                'status'        => 'n',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nama_supplier' => 'CV Berkah Bersama',
                'alamat'        => 'Jl. Ahmad Yani No. 8, Medan',
                'telepon'       => '0612345678',
                'email'         => 'berkahbersama@cv.com',
                'pic'           => 'Dewi Lestari',
                'kode_supplier' => 'SUP005',
                'keterangan'    => 'Supplier alat kebersihan',
                'status'        => 'y',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
