@extends('admin.layouts.master')
@section('title', 'Edit Kateogri')

@section('content')

    <div class="page-title mt-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Kategori</h3>
                <p class="text-subtitle text-muted">Silahkan isi data kategori yang ingin diubah</p>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body" action="">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="cat_name">Nama Kategori</label>
                                    <input type="text" name="cat_name"
                                           class="form-control @error('cat_name') is-invalid @enderror" id="cat_name"
                                           placeholder="Masukkan nama kategori" value="{{ old('cat_name', $category->cat_name) }}" required>
                                    @error('cat_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2"  for="description">Deskripsi</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="description" rows="3"
                                              placeholder="Masukkan deskripsi Kategori"
                                              required>{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-2 me-2 mb-1 mt-2">Simpan</button>
                                    <button type="reset" class="btn btn-danger rounded-2 me-2 mb-1 mt-2">Reset</button>
                                    <a href="{{ route('admin.roles.index') }}" type="submit" class="btn btn-light-secondary rounded-2 me-2 mb-1 mt-2">Batal</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
