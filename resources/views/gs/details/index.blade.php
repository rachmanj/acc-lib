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
        <div class="card-title">{{ $category->name }}</div>
        <button class="btn btn-sm btn-success float-right mx-2" data-toggle="modal" data-target="#modal-upload"><i class="fas fa-upload"></i> Upload</button>
        <a href="{{ route('gs.index') }}" class="btn btn-sm btn-primary float-right mx-2"><i class="fas fa-undo"></i>  Back</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="gs-detail" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Periode</th>
            <th>File Name</th>
            <th>Uploaded By</th>
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

<div class="modal fade" id="modal-upload">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> Document Upload</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('gs.upload', $category->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
      <div class="modal-body">
        <div class="form-group">
          <label for="month">Periode</label>
          <input name="month" type="month" class="form-control" id="month" autofocus required>
        </div>
          <label>Choose file to upload</label>
          <div class="form-group">
            <input type="file" name='file_upload' accept="application/pdf required class="form-control">
          </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"> Upload</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



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
      $("#gs-detail").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('gs.detail.data', $category->id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'month'},
          {data: 'filename'},
          {data: 'created_by'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection