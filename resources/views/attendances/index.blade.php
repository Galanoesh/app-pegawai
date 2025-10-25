@extends('master')
@section('title', 'Daftar Absensi')

@section('content')
<div class="container mt-5">

    {{-- Header + tombol tambah (muncul hanya jika ada data) --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Absensi</h1>
        @unless($attendances->isEmpty())
        <a href="{{ route('attendances.create') }}" class="btn btn-primary btn-sm">+ Tambah Absensi</a>
        @endunless
    </div>

    {{-- Empty state --}}
    @if($attendances->isEmpty())
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>Belum ada data absensi.</div>
        <a href="{{ route('attendances.create') }}" class="btn btn-primary btn-sm">+ Tambah Absensi</a>
    </div>
    @else
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status Absensi</th>
                <th class="text-center" style="width:180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
            <tr>
                <td>{{ $attendance->id }}</td>
                <td>{{ $attendance->employee->nama_lengkap ?? '-' }}</td>
                <td>{{ $attendance->tanggal }}</td>
                <td>{{ $attendance->waktu_masuk ?? '-' }}</td>
                <td>{{ $attendance->waktu_keluar ?? '-' }}</td>
                <td>
                    @php
                    $map = [
                    'hadir' => 'bg-success',
                    'izin' => 'bg-warning text-dark',
                    'sakit' => 'bg-info text-dark',
                    'alpha' => 'bg-danger'
                    ];
                    $cls = $map[$attendance->status_absensi] ?? 'bg-secondary';
                    @endphp
                    <span class="badge {{ $cls }}">{{ ucfirst($attendance->status_absensi) }}</span>
                </td>
                <td class="text-center">
                    <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Hapus absensi ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
@endsection