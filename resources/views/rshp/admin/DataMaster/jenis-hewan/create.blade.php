@extends('layouts.app')

@section('title', 'Tambah Jenis Hewan')

@section('content')
<style>
    /* Background page */
    body {
        background: linear-gradient(135deg, #FEEBC8, #F6AD55);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    /* Card animasi */
    .form-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 12px 28px rgba(0, 0, 0, 0.15);
    }

    /* Input style */
    input[type="text"] {
        transition: all 0.25s ease;
    }

    input[type="text"]:focus {
        border-color: #F6AD55;
        box-shadow: 0 0 0 3px rgba(246, 173, 85, 0.3);
    }

    /* Button hover */
    .btn-save {
        background-color: #F6AD55;
        transition: all 0.25s ease;
    }

    .btn-save:hover {
        background-color: #DD6B20;
        transform: scale(1.03);
    }

    .btn-back {
        transition: all 0.25s ease;
    }

    .btn-back:hover {
        background-color: #E2E8F0;
        transform: scale(1.03);
    }

    /* Title styling */
    .form-title {
        color: #2D3748;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem !important;
        }
    }
</style>

<div class="container mx-auto px-6 py-12">
    <div class="max-w-2xl mx-auto form-card p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl form-title">
                <i class="fa-solid fa-paw mr-2 text-amber-500"></i> Tambah Jenis Hewan
            </h2>
            <a href="{{ route('admin.jenis-hewan.index') }}" 
               class="text-gray-600 hover:text-gray-900 text-sm flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        {{-- Notifikasi error --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-semibold">Error!</strong> {{ session('error') }}
            </div>
        @endif

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <strong class="font-semibold">Sukses!</strong> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Input Nama Jenis Hewan --}}
            <div>
                <label for="nama_jenis_hewan" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Jenis Hewan <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="nama_jenis_hewan"
                       name="nama_jenis_hewan"
                       value="{{ old('nama_jenis_hewan') }}"
                       placeholder="Masukkan nama jenis hewan"
                       required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('nama_jenis_hewan') border-red-500 @enderror">
                @error('nama_jenis_hewan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol aksi --}}
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('admin.jenis-hewan.index') }}" 
                   class="btn-back px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg flex items-center">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                </a>

                <button type="submit" 
                        class="btn-save px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg flex items-center shadow-md">
                    <i class="fa-solid fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
