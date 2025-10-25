@extends('master')
@section('title', 'Detail Absensi')

@section('content')
<div class="container mt-5">
    <div class="detail-card">
        <div class="detail-card__header">
            <h2 class="mb-0">Detail Absensi</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('attendances.index') }}" class="btn btn-light btn-sm">← Kembali</a>
                <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
            </div>
        </div>

        <table class="detail-table table table-striped">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $attendance->id }}</td>
                </tr>
                <tr>
                    <th>Nama Karyawan</th>
                    <td>{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $attendance->tanggal }}</td>
                </tr>
                <tr>
                    <th>Waktu Masuk</th>
                    <td>{{ $attendance->waktu_masuk ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Waktu Keluar</th>
                    <td>{{ $attendance->waktu_keluar ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status Absensi</th>
                    <td>
                        @if($attendance->status_absensi == 'hadir')
                        <span class="badge bg-success px-3 py-2">Hadir</span>
                        @elseif($attendance->status_absensi == 'izin')
                        <span class="badge bg-warning text-dark px-3 py-2">Izin</span>
                        @elseif($attendance->status_absensi == 'sakit')
                        <span class="badge bg-info text-dark px-3 py-2">Sakit</span>
                        @else
                        <span class="badge bg-danger px-3 py-2">Alpha</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection