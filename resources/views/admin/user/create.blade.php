@extends('admin.layouts.master')
@section('title', 'Tambah Karyawan')

@section('content')

    <div class="page-title mt-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Data Karyawan</h3>
                <p class="text-subtitle text-muted">Silahkan isi data karyawan yang ingin ditambahkan</p>
            </div>
        </div>
    </div>

    <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                           placeholder="Masukkan username" value="{{ old('username') }}" required>
                                    @error('username')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="fullname">Nama Lengkap</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname"
                                           placeholder="Masukkan nama lengkap" value="{{ old('fullname') }}" required>
                                    @error('fullname')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Masukkan email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="phone">No Telepon</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                           placeholder="Masukkan nomor telepon" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Masukkan password" required>
                                    <small><a href="#" class="toggle-password"  data-target="password">Lihat Password</a></small>
                                    @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="password_confirmation">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           id="password_confirmation"
                                           placeholder="Konfirmasi password" required>
                                    <small><a href="#" class="toggle-password" data-target="password_confirmation">Lihat
                                            Password</a></small>
                                    @error('password_confirmation')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="mb-2 mt-2" for="role_id">Role</label>
                                    <select name="role_id" class="form-select" id="role_id" required>
                                        <option value="">Pilih Role</option>
                                        @foreach($roles as $role)
                                            @if($role->role_name !== 'customer')
                                                <option
                                                    value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
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

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.toggle-password').forEach(el => {
                el.addEventListener('click', function (e) {
                    e.preventDefault();

                    let input = document.getElementById(this.dataset.target);
                    let isHidden = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isHidden ? 'text' : 'password');
                    document.querySelector(`a[data-target="${this.dataset.target}"]`).textContent = isHidden ? 'Lihat Password' : 'Sembunyikan Password';

                });
            });
        });
    </script>
@endsection
