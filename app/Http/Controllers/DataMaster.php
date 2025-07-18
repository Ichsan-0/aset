<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TahunAjaran; 
use App\Models\Fakultas;
use App\Models\Kategori_barang;
use App\Models\Lokasi;
use App\Models\Supplier;
use App\Models\Barang;

class DataMaster extends Controller
{
    public function tahun()
    {
        return view('master.tahun');
    }
public function ajaxTahun(Request $request)
    {
    if ($request->ajax()) {
        $data = TahunAjaran::query();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item editBtn" data-id="'.$row->id.'">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </button>
                        <button class="dropdown-item deleteBtn" data-id="'.$row->id.'">
                            <i class="bx bx-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
    public function fakultas()
    {
        return view('master.fakultas');
    }

    public function ajaxFakultas(Request $request)
    {
        if ($request->ajax()) {
            $data = Fakultas::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item editBtn" data-id="'.$row->id.'">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </button>
                            <button class="dropdown-item deleteBtn" data-id="'.$row->id.'">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    // Store Fakultas
    public function storeFakultas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50',
            'ket'  => 'nullable|string',
        ]);

        $fakultas = Fakultas::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'ket'  => $request->ket,
        ]);

        return response()->json(['success' => true, 'message' => 'Fakultas berhasil ditambahkan', 'data' => $fakultas]);
    }

    // Edit Fakultas (get data)
    public function editFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return response()->json($fakultas);
    }

    // Update Fakultas
    public function updateFakultas(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:50',
            'ket'  => 'nullable|string',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'ket'  => $request->ket,
        ]);

        return response()->json(['success' => true, 'message' => 'Fakultas berhasil diupdate']);
    }

    // Delete Fakultas
    public function deleteFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();
        return response()->json(['success' => true, 'message' => 'Fakultas berhasil dihapus']);
    }
    public function prodi() 
    {
        $fakultas = Fakultas::all(); // Ambil data fakultas untuk dropdown
        return view('master.prodi', compact('fakultas'));
    }
    // AJAX DataTable
    public function ajaxProdi(Request $request)
    {
        if ($request->ajax()) {
            $data = Prodi::with('fakultas')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_fakultas', function($row){
                    return $row->fakultas ? $row->fakultas->nama : '-';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item editBtn" data-id="'.$row->id.'">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </button>
                            <button class="dropdown-item deleteBtn" data-id="'.$row->id.'">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    // Store Prodi
    public function storeProdi(Request $request)
    {
        $request->validate([
            'nama_prodi'   => 'required|string|max:255',
            'kode_prodi'   => 'required|string|max:50',
            'id_fakultas'  => 'required|exists:fakultas,id',
            'ket'          => 'nullable|string',
        ]);

        $prodi = Prodi::create($request->all());

        return response()->json(['success' => true, 'message' => 'Prodi berhasil ditambahkan', 'data' => $prodi]);
    }

    // Edit Prodi (get data)
    public function editProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        return response()->json($prodi);
    }

    // Update Prodi
    public function updateProdi(Request $request, $id)
    {
        $request->validate([
            'nama_prodi'   => 'required|string|max:255',
            'kode_prodi'   => 'required|string|max:50',
            'id_fakultas'  => 'required|exists:fakultas,id',
            'ket'          => 'nullable|string',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->all());

        return response()->json(['success' => true, 'message' => 'Prodi berhasil diupdate']);
    }

    // Delete Prodi
    public function deleteProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();
        return response()->json(['success' => true, 'message' => 'Prodi berhasil dihapus']);
    }

    // Tampilkan halaman
    public function kategoriBarang()
    {
        return view('master.kategori_barang');
    }


    public function ajaxKategoriBarang(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori_barang::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item editBtn" data-id="'.$row->id.'">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </button> 
                            <button class="dropdown-item deleteBtn" data-id="'.$row->id.'">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }
    public function storeKategoriBarang(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required|string|max:50',
            'nama_kategori' => 'required|string|max:255',
            'tipe_barang'   => 'required|string|max:50',
            'status'        => 'required|string|max:20',
            'urutan'        => 'nullable|integer',
        ]);

        $kategori = Kategori_barang::create($request->all());

        return response()->json(['success' => true, 'message' => 'Kategori berhasil ditambahkan', 'data' => $kategori]);
    }

    // Edit (get data)
    public function editKategoriBarang($id)
    {
        $kategori = Kategori_barang::findOrFail($id);
        return response()->json($kategori);
    }

    // Update
    public function updateKategoriBarang(Request $request, $id)
    {
        $request->validate([
            'kode_kategori' => 'required|string|max:50',
            'nama_kategori' => 'required|string|max:255',
            'tipe_barang'   => 'required|string|max:50',
            'status'        => 'required|string|max:20',
            'urutan'        => 'nullable|integer',
        ]);

        $kategori = Kategori_barang::findOrFail($id);
        $kategori->update($request->all());

        return response()->json(['success' => true, 'message' => 'Kategori berhasil diupdate']);
    }

    // Delete
    public function deleteKategoriBarang($id)
    {
        $kategori = Kategori_barang::findOrFail($id);
        $kategori->delete();
        return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus']);
    }

    public function lokasi()
    {
        return view('master.lokasi');
    }

    public function ajaxLokasi(Request $request)
    {
        if ($request->ajax()) {
            $data = Lokasi::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item editBtn" data-id="'.$row->id.'">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </button>
                            <button class="dropdown-item deleteBtn" data-id="'.$row->id.'">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->toJson(); 
        }
    }
    public function storeLokasi(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'gedung'     => 'required|string|max:50',
            'lantai'     => 'required|integer',
            'status'     => 'required|string|max:20',
            'keterangan'  => 'nullable|string',
        ]);

        $lokasi = Lokasi::create($request->all());

        return response()->json(['success' => true, 'message' => 'Lokasi berhasil ditambahkan', 'data' => $lokasi]);
    }

    public function editLokasi($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        return response()->json($lokasi);
    }
    public function updateLokasi(Request $request, $id)
    {
        $request->validate([
             'nama_lokasi' => 'required|string|max:255',
            'gedung'     => 'required|string|max:50',
            'lantai'     => 'required|integer',
            'status'     => 'required|string|max:20',
            'keterangan'  => 'nullable|string',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());

        return response()->json(['success' => true, 'message' => 'Lokasi berhasil diupdate']);
    }
    public function deleteLokasi($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();
        return response()->json(['success' => true, 'message' => 'Lokasi berhasil dihapus']);
    }

    public function supplier()
    {
        return view('master.supplier');
    }

    public function ajaxSupplier(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item editBtn" data-id="'.$row->id.'">  
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </button>
                            <button class="dropdown-item deleteBtn" data-id="'.$row->id.'">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
                })
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
