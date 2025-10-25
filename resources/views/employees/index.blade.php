@extends('master')
@section('title', 'Daftar Pegawai')

@section('content')
<div class="container mt-5">

    {{-- Header dan tombol tambah (muncul hanya jika ada data) --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Pegawai</h1>
        @unless($employees->isEmpty())
        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">+ Tambah Pegawai</a>
        @endunless
    </div>

    {{-- Tampilkan jika belum ada data pegawai --}}
    @if($employees->isEmpty())
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>Belum ada data pegawai.</div>
        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">+ Tambah Pegawai</a>
    </div>
    @else
    {{-- Tabel data pegawai --}}
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th class="text-center" style="width:180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->nama_lengkap }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->nomor_telepon }}</td>
                <td>{{ $employee->tanggal_lahir }}</td>
                <td>{{ $employee->alamat }}</td>
                <td>{{ $employee->tanggal_masuk }}</td>

                <td>
                    <span class="badge {{ $employee->status === 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($employee->status) }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection