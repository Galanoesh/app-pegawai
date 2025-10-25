@extends('master')
@section('title', 'Tambah Jabatan')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Form Jabatan</h2>
            <a href="{{ route('positions.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        {{-- Error list --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('positions.store') }}" method="POST" novalidate>
            @csrf

            {{-- Nama Jabatan --}}
            <div class="form-group">
                <label>Nama Jabatan</label>
                <input
                    type="text"
                    name="nama_jabatan"
                    value="{{ old('nama_jabatan') }}"
                    class="form-control @error('nama_jabatan') is-invalid @enderror"
                    placeholder="mis. Manajer, Staf HRD, Admin Keuangan"
                    required>
                @error('nama_jabatan')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            {{-- Gaji Pokok --}}
            <div class="form-group">
                <label>Gaji Pokok</label>
                <input
                    type="number"
                    name="gaji_pokok"
                    min="0" step="0.01"
                    value="{{ old('gaji_pokok') }}"
                    class="form-control @error('gaji_pokok') is-invalid @enderror"
                    placeholder="Masukkan nominal gaji pokok"
                    required>
                @error('gaji_pokok')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="form-actions">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('positions.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection