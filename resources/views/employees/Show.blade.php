@extends('master')
@section('title', 'Detail Pegawai')

@section('content')
<div class="container mt-5">

    <div class="detail-card">
        <div class="detail-card__header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Detail Pegawai</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('employees.index') }}" class="btn btn-light btn-sm">← Kembali</a>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
            </div>
        </div>

        <table class="detail-table table table-bordered mt-3">
            <tbody>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $employee->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $employee->email }}</td>
                </tr>
                <tr>
                    <th>Nomor Telepon</th>
                    <td>{{ $employee->nomor_telepon }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $employee->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $employee->alamat }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ $employee->tanggal_masuk }}</td>
                </tr>

                {{-- 🔹 Tambahan Department dan Position --}}
                <tr>
                    <th>Department</th>
                    <td>{{ optional($employee->department)->nama_departemen ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{ optional($employee->position)->nama_jabatan ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if ($employee->status === 'aktif')
                        <span class="badge text-bg-success">Aktif</span>
                        @else
                        <span class="badge text-bg-secondary">Nonaktif</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection