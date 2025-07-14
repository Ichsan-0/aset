<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori_barang extends Model
{
    protected $table = 'kategori_barangs'; // atau 'kategori_barang' sesuai nama tabel
    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'tipe_barang',
        'status',
        'urutan',
    ];
}
