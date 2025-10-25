@extends('master')
@section('title', 'Tambah Absensi')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Form Absensi</h2>
            <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        {{-- Global error list --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('attendances.store') }}" method="POST" novalidate>
            @csrf

            {{-- Nama Karyawan --}}
            <div class="form-group">
                <label>Nama Karyawan</label>
                <select name="karyawan_id" class="form-control @error('karyawan_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama_lengkap }}
                    </option>
                    @endforeach
                </select>
                @error('karyawan_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal --}}
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                    class="form-control @error('tanggal') is-invalid @enderror" required>
                @error('tanggal') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Waktu Masuk & Waktu Keluar --}}
            <div class="form-row">
                <div class="form-group">
                    <label>Waktu Masuk</label>
                    <input type="time" name="waktu_masuk" value="{{ old('waktu_masuk') }}"
                        class="form-control @error('waktu_masuk') is-invalid @enderror">
                    @error('waktu_masuk') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Waktu Keluar</label>
                    <input type="time" name="waktu_keluar" value="{{ old('waktu_keluar') }}"
                        class="form-control @error('waktu_keluar') is-invalid @enderror">
                    @error('waktu_keluar') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Status Absensi --}}
            <div class="form-group">
                <label>Status Absensi</label>
                <select name="status_absensi" class="form-control @error('status_absensi') is-invalid @enderror" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
                @error('status_absensi') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Tombol --}}
            <div class="form-actions">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('attendances.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection