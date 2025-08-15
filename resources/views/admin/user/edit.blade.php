@extends('admin.layouts.master')
@section('title', 'Edit Karyawan')

@section('content')

    <div class="page-title mt-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Data Karyawan</h3>
                <p class="text-subtitle text-muted">Silahkan isi data karyawan yang ingin diubah</p>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="username">Username</label>
                                    <input type="text" name="username"
                                           class="form-control @error('username') is-invalid @enderror" id="username"
                                           placeholder="Masukkan username" value="{{ old('username', $user->username) }}" required>
                                    @error('username')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="fullname">Nama Lengkap</label>
                                    <input type="text" name="fullname"
                                           class="form-control @error('fullname') is-invalid @enderror" id="fullname"
                                           placeholder="Masukkan nama lengkap" value="{{ old('fullname', $user->fullname) }}" required>
                                    @error('fullname')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="email">Email</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror" id="email"
                                           placeholder="Masukkan email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="phone">No Telepon</label>
                                    <input type="text" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror" id="phone"
                                           placeholder="Masukkan nomor telepon" value="{{ old('phone', $user->phone) }}"
                                           required>
                                    @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="role_id">Role</label>
                                    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror"
                                            id="role_id" required>
                                        <option value="">Pilih Role</option>
                                        @foreach($roles as $role)
                                            @if($role->role_name !== 'customer')
                                                <option
                                                    value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->role_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded-2 me-2 mb-1 mt-2">Simpan
                                    </button>
                                    <button type="reset" class="btn btn-danger rounded-2 me-2 mb-1 mt-2">Reset</button>
                                    <a href="{{ route('admin.users.index') }}"
                                       class="btn btn-light-secondary rounded-2 me-2 mb-1 mt-2">Batal</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@endsection

