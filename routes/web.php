<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataMaster;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn () => view('dashboard'));

Route::controller(DataMaster::class)->group(function () {
    // Prodi CRUD
    Route::get('/prodi', 'prodi')->name('prodi.index');
    Route::get('/prodi/ajax', 'ajaxProdi')->name('prodi.ajax');
    Route::post('/prodi/store', 'storeProdi')->name('prodi.store');
    Route::get('/prodi/edit/{id}', 'editProdi')->name('prodi.edit');
    Route::post('/prodi/update/{id}', 'updateProdi')->name('prodi.update');
    Route::delete('/prodi/delete/{id}', 'deleteProdi')->name('prodi.delete');

    Route::get('/tahun', 'tahun')->name('tahun.index');
    Route::get('/tahun/ajax', 'ajaxTahun')->name('tahun.ajax');
    // Fakultas CRUD
    Route::get('/fakultas', 'fakultas')->name('fakultas.index');
    Route::get('/fakultas/ajax', 'ajaxFakultas')->name('fakultas.ajax');
    Route::post('/fakultas/store', 'storeFakultas')->name('fakultas.store');
    Route::get('/fakultas/edit/{id}', 'editFakultas')->name('fakultas.edit');
    Route::post('/fakultas/update/{id}', 'updateFakultas')->name('fakultas.update');
    Route::delete('/fakultas/delete/{id}', 'deleteFakultas')->name('fakultas.delete');
    // Kategori Barang
    Route::get('/kategori_barang', 'kategoriBarang')->name('kategori_barang.index');
    Route::get('/kategori_barang/ajax', 'ajaxKategoriBarang')->name('kategori_barang.ajax');
    Route::post('/kategori_barang/store', 'storeKategoriBarang')->name('kategori_barang.store');
    Route::get('/kategori_barang/edit/{id}', 'editKategoriBarang')->name('kategori_barang.edit');
    Route::post('/kategori_barang/update/{id}', 'updateKategoriBarang')->name('kategori_barang.update');
    Route::delete('/kategori_barang/delete/{id}', 'deleteKategoriBarang')->name('kategori_barang.delete');
    // Lokasi
    Route::get('/lokasi', 'lokasi')->name('lokasi.index');
    Route::get('/lokasi/ajax', 'ajaxLokasi')->name('lokasi.ajax');
    Route::post('/lokasi/store', 'storeLokasi')->name('lokasi.store');
    Route::get('/lokasi/edit/{id}', 'editLokasi')->name('lokasi.edit');
    Route::post('/lokasi/update/{id}', 'updateLokasi')->name('lokasi.update');
    Route::delete('/lokasi/delete/{id}', 'deleteLokasi')->name('lokasi.delete');
    // Supplier
    Route::get('/supplier', 'supplier')->name('supplier.index');
    Route::get('/supplier/ajax', 'ajaxSupplier')->name('supplier.ajax');
    Route::post('/supplier/store', 'storeSupplier')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'editSupplier')->name('supplier.edit');
    Route::post('/supplier/update/{id}', 'updateSupplier')->name('supplier.update');
    Route::delete('/supplier/delete/{id}', 'deleteSupplier')->name('supplier.delete');

    Route::get('/user', 'user')->name('user.index');
    Route::get('/pimpinan', 'pimpinan')->name('pimpinan.index');
    
    Route::get('/barang', 'barang')->name('barang.index');
    
   
    Route::get('/penerimaan', 'penerimaan')->name('penerimaan.index');
    Route::get('/lainnya', 'lainnya')->name('lainnya.index');
});