@extends('master')
@section('title','Tambah Departemen')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Form Departemen</h2>
            <a href="{{ route('departments.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        {{-- Global error list (opsional) --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('departments.store') }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label>Nama Departemen</label>
                <input
                    type="text"
                    name="nama_departemen"
                    value="{{ old('nama_departemen') }}"
                    class="form-control @error('nama_departemen') is-invalid @enderror"
                    placeholder="mis. Keuangan, SDM, Produksi"
                    autofocus>
                @error('nama_departemen')
                <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-actions">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('departments.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection