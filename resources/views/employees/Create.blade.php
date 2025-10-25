@extends('master')
@section('title', 'Tambah Pegawai')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Form Pegawai</h2>
            <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        {{-- daftar error --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST" novalidate>
            @csrf

            {{-- Nama Lengkap --}}
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="form-control @error('nama_lengkap') is-invalid @enderror">
                @error('nama_lengkap') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Department --}}
            <div class="form-group">
                <label>Department</label>

                @if($departments->isEmpty())
                <div class="d-flex gap-2 align-items-center">
                    <select class="form-control" disabled>
                        <option>Belum ada data Department</option>
                    </select>
                    <a href="{{ route('departments.create') }}" class="btn btn-outline-secondary btn-sm">+ Tambah</a>
                </div>
                <small class="text-muted">Buat minimal satu department dulu.</small>
                @else
                <select name="departemen_id" class="form-control @error('departemen_id') is-invalid @enderror">
                    <option value="" disabled {{ old('departemen_id') ? '' : 'selected' }}>-- Pilih Department --</option>
                    @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('departemen_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->nama_departemen ?? $dept->name }}
                    </option>
                    @endforeach
                </select>
                @error('departemen_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
                @endif
            </div>

            {{-- Position --}}
            <div class="form-group">
                <label>Position</label>

                @if($positions->isEmpty())
                <div class="d-flex gap-2 align-items-center">
                    <select class="form-control" disabled>
                        <option>Belum ada data Position</option>
                    </select>
                    <a href="{{ route('positions.create') }}" class="btn btn-outline-secondary btn-sm">+ Tambah</a>
                </div>
                <small class="text-muted">Buat minimal satu position dulu.</small>
                @else
                <select name="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror">
                    <option value="" disabled {{ old('jabatan_id') ? '' : 'selected' }}>-- Pilih Position --</option>
                    @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ old('jabatan_id') == $pos->id ? 'selected' : '' }}>
                        {{ $pos->nama_jabatan ?? $pos->name }}
                    </option>
                    @endforeach
                </select>
                @error('jabatan_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
                @endif
            </div>


            {{-- Nomor Telepon --}}
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                    class="form-control @error('nomor_telepon') is-invalid @enderror">
                @error('nomor_telepon') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>
            {{-- Tanggal Lahir & Tanggal Masuk --}}
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                        class="form-control @error('tanggal_masuk') is-invalid @enderror">
                    @error('tanggal_masuk') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3"
                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                @error('alamat') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="aktif" {{ old('status')=='aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status')=='nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Tombol --}}
            <div class="form-actions">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('employees.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection