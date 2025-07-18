@extends('layout.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h5 class="mb-0">Data Pimpinan Fakultas</h5>
      <button class="btn btn-primary" id="addBtn">
        <i class="bx bx-plus"></i> Tambah Pimpinan
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table id="pimpinanTable" class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Pimpinan</th>
              <th>Jabatan</th>
              <th>NIP</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="pimpinanModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="pimpinanForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pimpinan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_pimpinan" class="form-label">Nama Pimpinan</label>
            <input type="text" class="form-control" name="nama_pimpinan" required>
          </div>
          <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" name="jabatan" required>
          </div>
          <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" name="nip" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="ket" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
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
    var table = $('#pimpinanTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("pimpinan.ajax") }}',
        autoWidth: false, 
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_pimpinan', name: 'nama_pimpinan' },
            { data: 'jabatan', name: 'jabatan' },
            { data: 'nip', name: 'nip' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#addBtn').on('click', function () {
        $('#pimpinanForm')[0].reset();
        $('#pimpinanModal').modal('show');
    });

    $('#pimpinanForm').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route("pimpinan.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#pimpinanModal').modal('hide');
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