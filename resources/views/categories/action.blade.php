<form action="{{ route('categories.destroy', $model->id) }}" method="POST">
    @csrf @method('DELETE')
      <a href="{{ route('categories.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
</form>