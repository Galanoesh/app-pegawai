@extends('master')
@section('title', 'Edit Pegawai')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Edit Data Pegawai</h2>
            <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        {{-- Error List --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Nama Lengkap --}}
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap"
                    value="{{ old('nama_lengkap', $employee->nama_lengkap) }}"
                    class="form-control @error('nama_lengkap') is-invalid @enderror">
                @error('nama_lengkap') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $employee->email) }}"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Departemen --}}
            <div class="form-group">
                <label>Departemen</label>
                <select name="departemen_id" class="form-control @error('departemen_id') is-invalid @enderror">
                    <option value="">— Pilih Departemen —</option>
                    @foreach ($departments as $d)
                    <option value="{{ $d->id }}"
                        {{ (string) old('departemen_id', $employee->departemen_id) === (string) $d->id ? 'selected' : '' }}>
                        {{ $d->nama_departemen ?? $d->nama ?? $d->name }}
                    </option>
                    @endforeach
                </select>
                @error('departemen_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Jabatan / Position --}}
            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror">
                    <option value="">— Pilih Jabatan —</option>
                    @foreach ($positions as $p)
                    <option value="{{ $p->id }}"
                        {{ (string) old('jabatan_id', $employee->jabatan_id) === (string) $p->id ? 'selected' : '' }}>
                        {{ $p->nama_jabatan ?? $p->nama ?? $p->name }}
                    </option>
                    @endforeach
                </select>
                @error('jabatan_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>
            
            {{-- Nomor Telepon --}}
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="nomor_telepon"
                    value="{{ old('nomor_telepon', $employee->nomor_telepon) }}"
                    class="form-control @error('nomor_telepon') is-invalid @enderror">
                @error('nomor_telepon') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal Lahir & Masuk --}}
            <div class="form-row">
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk"
                        value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}"
                        class="form-control @error('tanggal_masuk') is-invalid @enderror">
                    @error('tanggal_masuk') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Alamat --}}
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3"
                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $employee->alamat) }}</textarea>
                @error('alamat') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Tombol --}}
            <div class="form-actions">
                <button class="btn btn-primary">Perbarui</button>
                <a href="{{ route('employees.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection