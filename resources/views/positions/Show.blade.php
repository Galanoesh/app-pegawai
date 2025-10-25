@extends('master')
@section('title', 'Detail Jabatan')

@section('content')
<div class="container mt-5">
    <div class="detail-card">
        <div class="detail-card__header">
            <h2 class="mb-0">Detail Jabatan</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('positions.index') }}" class="btn btn-light btn-sm">← Kembali</a>
                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
            </div>
        </div>

        <table class="detail-table table table-striped">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $position->id }}</td>
                </tr>
                <tr>
                    <th>Nama Jabatan</th>
                    <td>{{ $position->nama_jabatan }}</td>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <td>Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection