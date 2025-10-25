@extends('master')
@section('title', 'Detail Gaji')

@section('content')
<div class="container mt-5">
    <div class="detail-card">
        <div class="detail-card__header">
            <h2 class="mb-0">Detail Gaji</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('salaries.index') }}" class="btn btn-light btn-sm">← Kembali</a>
                <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
            </div>
        </div>

        <table class="detail-table table table-striped">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $salary->id }}</td>
                </tr>
                <tr>
                    <th>Karyawan</th>
                    <td>{{ $salary->employee->nama_lengkap ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Bulan</th>
                    <td>{{ $salary->bulan }}</td>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tunjangan</th>
                    <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Potongan</th>
                    <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Gaji</th>
                    <td>
                        <span class="fw-bold text-success">
                            Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection