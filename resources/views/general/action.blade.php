<a href="{{ route('general.show', $model->id) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-search"></i></a>

@hasanyrole('superadmin|admin')
<form action="{{ route('general.destroy_category', $model->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Yakin ingin menghapus record ini?')" {{ $model->category_details->count() > 0 ? 'disabled' : '' }} data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
</form>
@endhasanyrole
