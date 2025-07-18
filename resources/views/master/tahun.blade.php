@extends('layout.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
      <h5 class="mb-0">Data Tahun Ajaran</h5>
      <button class="btn btn-primary">
        <i class="bx bx-plus"></i> Tahun Ajaran Baru
      </button>
    </div>

    <div class="card-body">
      

      <div class="table-responsive text-nowrap">
        <table id="prodiTable" class="table table-hover">
          <thead>
            <tr>
              <th>No.</th>
              <th>Keterangan</th>
              <th>Periode Awal</th>
              <th>Periode Akhir</th>
              <th>Status</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
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
    function formatDate(data) {
        if (!data) return '';
        const date = new Date(data);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = String(date.getFullYear());
        return `${day} / ${month} / ${year}`;
    }

    $('#prodiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("tahun.ajax") }}',
        autoWidth: false, 
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            { data: 'ket', name: 'ket' },
            {
                data: 'periode_awal',
                name: 'periode_awal',
                render: formatDate
            },
            {
                data: 'periode_akhir',
                name: 'periode_akhir',
                render: formatDate
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>

@endpush
