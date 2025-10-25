@extends('master')
@section('title','Edit Departemen')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Edit Data Departemen</h2>
            <a href="{{ route('departments.index') }}" class="btn btn-light btn-sm">← Kembali</a>
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

        <form action="{{ route('departments.update', $department->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Nama Departemen --}}
            <div class="form-group">
                <label>Nama Departemen</label>
                <input
                    type="text"
                    name="nama_departemen"
                    value="{{ old('nama_departemen', $department->nama_departemen) }}"
                    class="form-control @error('nama_departemen') is-invalid @enderror"
                    placeholder="mis. Keuangan, SDM, Produksi"
                    required>
                @error('nama_departemen')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="form-actions">
                <button class="btn btn-primary">Perbarui</button>
                <a href="{{ route('departments.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection