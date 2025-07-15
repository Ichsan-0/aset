@extends('layout.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h5 class="mb-0">Data Supplier</h5>
      <button class="btn btn-primary" id="addBtn">
        <i class="bx bx-plus"></i> Supplier
      </button>
    </div>

    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table id="supplierTable" class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama Supplier</th>
              <th>Alamat</th>
              <th>Telepon</th>
              <th>Email</th>
              <th>PIC</th>
              <th>Kode Supplier</th>
              <th>Keterangan</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="supplierModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="supplierForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="supplier_id">
          <div class="mb-3">
            <label class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" class="form-control" name="telepon" id="telepon" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email">
          </div>
          <div class="mb-3">
            <label class="form-label">PIC</label>
            <input type="text" class="form-control" name="pic" id="pic">
          </div>
          <div class="mb-3">
            <label class="form-label">Kode Supplier</label>
            <input type="text" class="form-control" name="kode_supplier" id="kode_supplier" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status" id="status" required>
              <option value="">-- Pilih Status --</option>
              <option value="y">Aktif</option>
              <option value="n">Tidak Aktif</option>
            </select>
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
    var table = $('#supplierTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("supplier.ajax") }}',
        autoWidth: false,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_supplier', name: 'nama_supplier' },
            { data: 'alamat', name: 'alamat' },
            { data: 'telepon', name: 'telepon' },
            { data: 'email', name: 'email' },
            { data: 'pic', name: 'pic' },
            { data: 'kode_supplier', name: 'kode_supplier' },
            { data: 'keterangan', name: 'keterangan' },
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
        $('#supplierForm')[0].reset();
        $('#supplier_id').val('');
        $('.modal-title').text('Tambah Supplier');
        $('#supplierModal').modal('show');
    });

    // show modal for edit
    $(document).on('click', '.editBtn', function () {
        var id = $(this).data('id');
        $.get('/supplier/edit/' + id, function (data) {
            $('#supplier_id').val(data.id);
            $('#nama_supplier').val(data.nama_supplier);
            $('#alamat').val(data.alamat);
            $('#telepon').val(data.telepon);
            $('#email').val(data.email);
            $('#pic').val(data.pic);
            $('#kode_supplier').val(data.kode_supplier);
            $('#keterangan').val(data.keterangan);
            $('#status').val(data.status);
            $('.modal-title').text('Edit Supplier (' + data.nama_supplier + ')');
            $('#supplierModal').modal('show');
        });
    });

    // submit form (add/update)
    $('#supplierForm').on('submit', function (e) {
        e.preventDefault();
        var id = $('#supplier_id').val();
        var url = id ? '/supplier/update/' + id : '/supplier/store';
        var method = 'POST';
        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                    $('#supplierModal').modal('hide');
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
            url: '/supplier/delete/' + id,
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

