@extends('layout.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h5 class="mb-0">Data Ruangan / Lokasi</h5>
      <button class="btn btn-primary" id="addBtn">
        <i class="bx bx-plus"></i> Lokasi
      </button>
    </div>

    <div class="card-body">
      

      <div class="table-responsive text-nowrap">
        <table id="lokasiTable" class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Lokasi</th>
              <th>Gedung</th>
              <th>lantai</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="lokasiModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="lokasiForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="lokasi_id">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Nama Lokasi</label>
                <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label class="form-label">Gedung</label>
                <select class="form-select" name="gedung" id="gedung" required>
                  <option value="">-- Pilih Lantai --</option>
                  <option value="A">Gedung A</option>
                  <option value="B">Gedung B</option>
                  <option value="C">Gedung C</option>
                </select>
              </div>
            </div>
          </div>
               
          <div class="mb-3">
            <label class="form-label">Lantai</label>
            <input type="number" class="form-control" name="lantai" id="lantai" required>
          </div>
          <div class="mb-3">
            <label  class="form-label">Status</label>
            <select class="form-select" name="status" id="status" required>
              <option value="">-- Pilih Status--</option>
               <option value="y">Aktif</option>
               <option value="n">Tidak Aktif</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="ket" id="ket"></textarea>
          </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>

@endsection

@push('styles')
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
$(function () {
    var table = $('#lokasiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("lokasi.ajax") }}',
        autoWidth: false,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_lokasi', name: 'nama_lokasi' },
            { data: 'gedung', name: 'gedung' },
            { data: 'lantai', name: 'lantai' },
            { data: 'status', name: 'status',
              render: function(data, type, row) {
                return data === 'y' ? 'Aktif' : 'Tidak Aktif';
              }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // show modal for add
    $('#addBtn').on('click', function () {
        $('#lokasiForm')[0].reset();
        $('#lokasi_id').val(''); // <-- pastikan ini juga
        $('.modal-title').text('Tambah Ruang /Lokasi');
        $('#lokasiModal').modal('show');
    });

    // show modal for edit
    $(document).on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get('/lokasi/edit/' + id, function (data) {
            $('#lokasi_id').val(data.id); // <-- ini yang benar
            $('#nama_kategori').val(data.nama_kategori);
            $('#kode_kategori').val(data.kode_kategori);
            $('#tipe_barang').val(data.tipe_barang);
            $('#status').val(data.status);
            $('#ket').val(data.ket);
            $('#urutan').val(data.urutan);
            $('.modal-title').text('Edit kategori barang');
            $('#lokasiModal').modal('show');
        });
    });

    // submit form (add/update)
    $('#lokasiForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#lokasi_id').val();
        var url = id ? '/lokasi/update/' + id : '/lokasi/store';
        var method = id ? 'POST' : 'POST';
        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#lokasiModal').modal('hide');
                    table.ajax.reload();
                    alert(res.message);
                }
            },
            error: function (xhr) {
                alert('Terjadi kesalahan!');
                console.log(xhr.responseText);
            }
        });
    });

    // delete
    $(document).on('click', '.deleteBtn', function () {
        if (!confirm('Yakin ingin menghapus data ini?')) return;
        var id = $(this).data('id');
        $.ajax({
            url: '/lokasi/delete/' + id,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (res) {
                if (res.success) {
                    table.ajax.reload();
                    alert(res.message);
                }
            },
            error: function (xhr) {
                alert('Terjadi kesalahan!');
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
@endpush
