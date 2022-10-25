<a href="{{ asset('document_upload/'. $model->filename) }}" class="btn btn-xs btn-success" target="_blank">preview</a>
<form action="{{ route('gs.detail.destroy', $model->id) }}" method="POST" >
    @csrf @method('DELETE')
    @hasanyrole('admin')
    <button  type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger" >delete</button>
    @endhasanyrole
</form>
<button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#gs-edit-{{ $model->id }}">edit</button>

<div class="modal fade" id="gs-edit-{{ $model->id }}">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('gs.update', $model->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="month">Periode</label>
            <input name="month" value="{{ $model->month }}" type="month" class="form-control" id="month" autofocus required>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
        </div>
      </form>
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->