<form action="{{ route('gs.detail.destroy', $model->id) }}" method="POST">
    @csrf @method('DELETE')
      <a href="{{ asset('document_upload/'. $model->filename) }}" class="btn btn-xs btn-success" target="_blank">preview</a>
      @hasanyrole('admin')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
      @endhasanyrole
</form>