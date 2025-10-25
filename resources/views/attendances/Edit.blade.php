@extends('master')
@section('title','Edit Absensi')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Edit Data Absensi</h2>
            <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Karyawan --}}
            <div class="form-group">
                <label>Nama Karyawan</label>
                <select name="karyawan_id" class="form-control @error('karyawan_id') is-invalid @enderror" required>
                    @foreach ($employees as $e)
                    <option value="{{ $e->id }}"
                        {{ old('karyawan_id', $attendance->karyawan_id) == $e->id ? 'selected' : '' }}>
                        {{ $e->nama_lengkap }}
                    </option>
                    @endforeach
                </select>
                @error('karyawan_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal --}}
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal"
                    value="{{ old('tanggal', $attendance->tanggal) }}"
                    class="form-control @error('tanggal') is-invalid @enderror" required>
                @error('tanggal') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            <div class="form-row">
                {{-- Waktu Masuk --}}
                <div class="form-group">
                    <label>Waktu Masuk</label>
                    <input type="time" name="waktu_masuk"
                        value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}"
                        class="form-control @error('waktu_masuk') is-invalid @enderror">
                    @error('waktu_masuk') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>

                {{-- Waktu Keluar --}}
                <div class="form-group">
                    <label>Waktu Keluar</label>
                    <input type="time" name="waktu_keluar"
                        value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}"
                        class="form-control @error('waktu_keluar') is-invalid @enderror">
                    @error('waktu_keluar') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status Absensi</label>
                <select name="status_absensi" class="form-control @error('status_absensi') is-invalid @enderror" required>
                    @foreach (['hadir','izin','sakit','alpha'] as $s)
                    <option value="{{ $s }}" {{ old('status_absensi', $attendance->status_absensi) == $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                    @endforeach
                </select>
                @error('status_absensi') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            <div class="form-actions">
                <button class="btn btn-primary">Perbarui</button>
                <a href="{{ route('attendances.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection