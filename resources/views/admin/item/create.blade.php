@extends('admin.layouts.master')
@section('title', 'Tambah Menu')

@section('content')

    <div class="page-title mt-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Data Menu</h3>
                <p class="text-subtitle text-muted">Silahkan isi data menu yang ingin ditambahkan</p>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('admin.items.store') }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-body" action="">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="name">Nama Menu</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Masukkan nama menu" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="description">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="description" rows="3"
                                              placeholder="Masukkan deskripsi menu"
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="price">Harga</label>
                                    <input type="number" name="price" class="form-control" id="price"
                                           placeholder="Masukkan harga menu" value="{{ old('price') }}" required>
                                    @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="category">Kategori</label>
                                    <select name="category_id" id="category" class="form-control" required>
                                        <option value="" disabled selected>Pilih Menu</option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="img">Gambar Menu</label>
                                    <input type="file" name="img" class="form-control" id="img" accept="image/*"
                                           required>
                                    <span class="text-muted text-sm">File harus berupa gambar (jpeg/png/jpg/gif/svg) dengan ukuran maksimal 2MB</span>
                                    @error('img')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="status">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" name="is_active" role="switch"
                                               id="flexSwitchCheckDefault"
                                               value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Kosong/Tersedia</label>
                                    </div>
                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-2 me-2 mb-1 mt-2">Simpan</button>
                                    <button type="reset" class="btn btn-danger rounded-2 me-2 mb-1 mt-2">Reset</button>
                                    <a href="{{ route('admin.items.index') }}" type="submit" class="btn btn-light-secondary rounded-2 me-2 mb-1 mt-2">Batal</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection
