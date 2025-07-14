@extends('layout.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h5 class="mb-0">Data Kategori Barang</h5>
      <button class="btn btn-primary" id="addBtn">
        <i class="bx bx-plus"></i> Kategori Barang
      </button>
    </div>

    <div class="card-body">
      

      <div class="table-responsive text-nowrap">
        <table id="kategori_barangTable" class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kode</th>
              <th>Nama</th>
              <th>Tipe</th>
              <th>Status</th>
              <th>Urutan</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="kategori_barangModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="kategori_barangForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="kategori_barang_id">
          <div class="mb-3">
            <label class="form-label">Nama kategori barang</label>
            <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Kode Kategori Barang</label>
            <input type="text" class="form-control" name="kode_kategori" id="kode_kategori" required>
          </div>
               
          <div class="mb-3">
            <label class="form-label">Tipe Barang</label>
            <select class="form-select" name="tipe_barang" id="tipe_barang" required>
              <option value="">-- Pilih Tipe Barang --</option>
              <option value="A">Barang</option>
              <option value="B">Jasa</option>
            </select>
          </div>
          <div class="mb-3">
            <label  class="form-label">Status</label>
            <select class="form-select" name="status" id="status" required>
              <option value="">-- Pilih Status--</option>
              <option value="1">Aktif </option>
              <option value="2">Non Aktif</option>
              <option value="3">Draft</option>
              <option value="4">Arsip</option>
              <option value="5">Dihapus</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="ket" id="ket"></textarea>
          </div>
          <div class="mb-3">
            <label for="urutan" class="form-label">Urutan</label>
            <input type="number" class="form-control" name="urutan" id="urutan">
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
    var table = $('#kategori_barangTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("kategori_barang.ajax") }}',
        autoWidth: false,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode_kategori', name: 'kode_kategori' },
            { data: 'nama_kategori', name: 'nama_kategori' },
            { data: 'tipe_barang', name: 'tipe_barang' },
            { data: 'status', name: 'status' },
            { data: 'urutan', name: 'urutan' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // show modal for add
    $('#addBtn').on('click', function () {
        $('#kategori_barangForm')[0].reset();
        $('#id').val('');
        $('.modal-title').text('Tambah kategori_barang');
        $('#kategori_barangModal').modal('show');
    });

    // show modal for edit
    $(document).on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get('/kategori_barang/edit/' + id, function (data) {
            $('#kategori_barang_id').val(data.id);
            $('#nama').val(data.nama);
            $('#kode').val(data.kode);
            $('#ket').val(data.ket);
            $('.modal-title').text('Edit kategori_barang');
            $('#kategori_barangModal').modal('show');
        });
    });

    // submit form (add/update)
    $('#kategori_barangForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#kategori_barang_id').val();
        var url = id ? '/kategori_barang/update/' + id : '/kategori_barang/store';
        var method = id ? 'POST' : 'POST';
        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#kategori_barangModal').modal('hide');
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
            url: '/kategori_barang/delete/' + id,
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
