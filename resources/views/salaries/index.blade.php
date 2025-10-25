@extends('master')
@section('title', 'Daftar Gaji')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Gaji</h1>
        @unless($salaries->isEmpty())
        <a href="{{ route('salaries.create') }}" class="btn btn-primary btn-sm">+ Tambah Gaji</a>
        @endunless
    </div>

    @if($salaries->isEmpty())
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>Belum ada data gaji.</div>
        <a href="{{ route('salaries.create') }}" class="btn btn-primary btn-sm">+ Tambah Gaji</a>
    </div>
    @else
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->id }}</td>
                <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
                <td>{{ $salary->bulan }}</td>
                <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                <td>
                    <strong>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong>
                </td>
                <td class="text-center">
                    <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Yakin ingin menghapus data gaji ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection