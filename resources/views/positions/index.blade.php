@extends('master')
@section('title', 'Daftar Jabatan')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Daftar Jabatan</h1>
        @unless($positions->isEmpty())
        <a href="{{ route('positions.create') }}" class="btn btn-primary btn-sm">+ Tambah Jabatan</a>
        @endunless
    </div>

    @if($positions->isEmpty())

    <div class="alert alert-info d-flex justify-content-between align-items-center">
        <div>Belum ada data jabatan.</div>
        <a href="{{ route('positions.create') }}" class="btn btn-primary btn-sm">+ Tambah Jabatan</a>
    </div>
    @else
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th style="width:180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($positions as $position)
            <tr>
                <td>{{ $position->id }}</td>
                <td>{{ $position->nama_jabatan }}</td>
                <td>Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('positions.show', $position->id) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                    <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

</div>
@endsection