@extends('admin.layouts.master')
@section('title', 'Edit Role')

@section('content')

    <div class="page-title mt-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Role</h3>
                <p class="text-subtitle text-muted">Silahkan isi data role yang ingin diubah</p>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('admin.roles.update', $role->id) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-body" action="">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="role_name">Nama Role</label>
                                    <input type="text" name="role_name"
                                           class="form-control @error('role_name') is-invalid @enderror" id="role_name"
                                           placeholder="Masukkan nama role" value="{{ $role->role_name }}" required>
                                    @error('role_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2"  for="description">Deskripsi</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="description" rows="3"
                                              placeholder="Masukkan deskripsi role"
                                              required>{{ $role->description }}</textarea>
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
