@extends('templates.main')

@section('title_page')
    GS Parameter
@endsection

@section('breadcrumb_title')
    gs
@endsection

@section('content')
<div class="row">
  <div class="col-12">

    <div class="card">
      <div class="card-header">
        @if (Session::has('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('success') }}
          </div>
        @endif
        <a href="{{ route('gs.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> GS Category</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="categories" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Category Name</th>
            <th>Doc Count</th>
            <th>CreatedBy</th>
            <th>action</th>
          </tr>
          </thead>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/datatables/css/datatables.min.css') }}"/>
@endsection

@section('scripts')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables/datatables.min.js') }}"></script>

  <script>
    $(function () {
      $("#categories").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('gs.index.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'name'},
          {data: 'doc_count'},
          {data: 'created_by'},
          {data: 'action'},
        ],
        fixedHeader: true,
        columnDefs: [
          {
            "targets": [2],
            "className": "text-right"
          }
        ]
      })
    });
  </script>

@endsection