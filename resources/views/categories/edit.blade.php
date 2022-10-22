@extends('templates.main')

@section('title_page')
    Categories
@endsection

@section('breadcrumb_title')
    categories
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit Category</h3>
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-success float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @method('PUT') @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" value="{{ $category->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" autofocus>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="name">Type</label>
                <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                  <option value="general" {{ $category->type === 'general' ? 'selected' : null }}>General</option>
                  <option value="gs" {{ $category->type === 'gs' ? 'selected' : null }}>GS</option>
                </select>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>  Save</button>
            </div>
          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection
