@extends('master')
@section('title', 'Edit Gaji')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Edit Data Gaji</h2>
            <a href="{{ route('salaries.index') }}" class="btn btn-light btn-sm">← Kembali</a>
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

        <form action="{{ route('salaries.update', $salary->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            {{-- Karyawan --}}
            <div class="form-group">
                <label>Karyawan</label>
                <select name="karyawan_id" class="form-control @error('karyawan_id') is-invalid @enderror" required>
                    @foreach ($employees as $e)
                    <option value="{{ $e->id }}"
                        {{ old('karyawan_id', $salary->karyawan_id) == $e->id ? 'selected' : '' }}>
                        {{ $e->nama_lengkap }}
                    </option>
                    @endforeach
                </select>
                @error('karyawan_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- Bulan (YYYY-MM) --}}
            <div class="form-group">
                <label>Bulan</label>
                <input type="month" name="bulan"
                    value="{{ old('bulan', $salary->bulan) }}"
                    class="form-control @error('bulan') is-invalid @enderror" required>
                @error('bulan') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            <div class="form-row">
                {{-- Gaji Pokok --}}
                <div class="form-group">
                    <label>Gaji Pokok</label>
                    <input type="number" name="gaji_pokok" min="0" step="0.01"
                        value="{{ old('gaji_pokok', $salary->gaji_pokok) }}"
                        class="form-control @error('gaji_pokok') is-invalid @enderror" required>
                    @error('gaji_pokok') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>

                {{-- Tunjangan --}}
                <div class="form-group">
                    <label>Tunjangan</label>
                    <input type="number" name="tunjangan" min="0" step="0.01"
                        value="{{ old('tunjangan', $salary->tunjangan) }}"
                        class="form-control @error('tunjangan') is-invalid @enderror">
                    @error('tunjangan') <small class="invalid-feedback">{{ $message }}</small> @enderror
                </div>
            </div>

            {{-- Potongan --}}
            <div class="form-group">
                <label>Potongan</label>
                <input type="number" name="potongan" min="0" step="0.01"
                    value="{{ old('potongan', $salary->potongan) }}"
                    class="form-control @error('potongan') is-invalid @enderror">
                @error('potongan') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            <div class="form-actions">
                <button class="btn btn-primary">Perbarui</button>
                <a href="{{ route('salaries.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection