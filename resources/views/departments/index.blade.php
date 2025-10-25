@extends('master')
@section('title', 'Daftar Departemen')

@section('content')
<div class="container mt-5">

    {{-- Header & tombol tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Departemen</h1>
        @unless($departments->isEmpty())
        <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">+ Tambah Departemen</a>
        @endunless
    </div>

    {{-- Jika belum ada data --}}
    @if($departments->isEmpty())
    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>Belum ada data departemen.</div>
        <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">+ Tambah Departemen</a>
    </div>
    @else
    {{-- Tabel data departemen --}}
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th width="80">ID</th>
                <th>Nama Departemen</th>
                <th class="text-center" width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->nama_departemen }}</td>
                <td class="text-center">
                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Yakin ingin menghapus departemen ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
@endsection