@extends('admin.layouts.master')
@section('title', 'Edit Menu')

@section('content')

    <div class="page-title mt-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Menu</h3>
                <p class="text-subtitle text-muted">Silahkan isi data menu yang ingin diubah</p>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('admin.items.update', $item->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-body" action="">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="name">Nama Menu</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="Masukkan nama menu" value="{{ $item->name }}" required>
                                    @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2"  for="description">Deskripsi</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="description" rows="3"
                                              placeholder="Masukkan deskripsi menu"
                                              required>{{ $item->description }}</textarea>
                                    @error('description')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="mb-2 mt-2" for="price">Harga</label>
                                    <input type="number" name="price"
                                           class="form-control @error('price') is-invalid @enderror" id="price"
                                           placeholder="Masukkan harga menu" value="{{ $item->price }}" required>
                                    @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2"  for="category">Kategori</label>
                                    <select name="category_id" id="category"
                                            class="form-control @error('category_id') is-invalid @enderror" required>
                                        <option value="" disabled>Pilih Menu</option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label  class="mb-2 mt-2" for="img">Gambar Menu</label>
                                    @if ($item->img)
                                        <div class="mt-2 mb-2">
                                            <img src="{{ asset('img_item_upload/' . $item->img) }}" alt="{{ $item->name }}"
                                                 class="img-thumbnail mb-2" style="width: 130px; height: 130px; "
                                                onerror="this.onerror=null;this.src='{{ $item->img }}';">
                                        </div>
                                    @endif
                                    <input type="file" name="img"
                                           class="form-control @error('img') is-invalid @enderror" id="img"
                                           accept="image/*">
                                    <span class="text-muted text-sm">File harus berupa gambar (jpeg/png/jpg/gif/svg) dengan ukuran maksimal 2MB</span>
                                    @error('img')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2"  for="status">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" name="is_active" role="switch"
                                               id="flexSwitchCheckDefault"
                                               value="1" {{ $item->is_active ? 'checked' : '' }}>
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
