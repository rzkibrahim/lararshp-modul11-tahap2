@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit User: {{ $user->nama_lengkap }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Username -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username" class="form-label">
                                        Username <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('username') is-invalid @enderror" 
                                        id="username" 
                                        name="username" 
                                        value="{{ old('username', $user->username) }}" 
                                        placeholder="Masukkan username"
                                        required
                                    >
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">
                                        Email <span class="text-danger">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        id="email" 
                                        name="email" 
                                        value="{{ old('email', $user->email) }}" 
                                        placeholder="contoh@email.com"
                                        required
                                    >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            Biarkan kosong jika tidak ingin mengubah password
                        </div>

                        <div class="row">
                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input 
                                        type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Minimal 8 karakter (kosongkan jika tidak diubah)"
                                    >
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        Konfirmasi Password Baru
                                    </label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password_confirmation" 
                                        name="password_confirmation" 
                                        placeholder="Ulangi password baru"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="form-group mb-3">
                            <label for="nama_lengkap" class="form-label">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                id="nama_lengkap" 
                                name="nama_lengkap" 
                                value="{{ old('nama_lengkap', $user->nama_lengkap) }}" 
                                placeholder="Masukkan nama lengkap"
                                required
                            >
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No Telepon -->
                        <div class="form-group mb-3">
                            <label for="no_telepon" class="form-label">No Telepon</label>
                            <input 
                                type="text" 
                                class="form-control @error('no_telepon') is-invalid @enderror" 
                                id="no_telepon" 
                                name="no_telepon" 
                                value="{{ old('no_telepon', $user->no_telepon) }}" 
                                placeholder="08xxxxxxxxxx"
                            >
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="form-group mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea 
                                class="form-control @error('alamat') is-invalid @enderror" 
                                id="alamat" 
                                name="alamat" 
                                rows="3" 
                                placeholder="Masukkan alamat lengkap"
                            >{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update
                            </button>
                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection