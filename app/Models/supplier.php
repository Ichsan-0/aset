<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers'; // nama tabel
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon',
        'email',
        'pic',
        'kode_supplier',
        'keterangan',
        'status',
    ];
}
