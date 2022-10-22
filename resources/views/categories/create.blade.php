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
            <h3 class="card-title">Create New Category</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" autofocus>
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="name">Type</label>
                <select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
                  <option value="">-- Choose Type --</option>
                  <option value="general">General</option>
                  <option value="gs">GS</option>
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