@extends('master')
@section('title', 'Detail Departemen')

@section('content')
<div class="container mt-5">
    <div class="detail-card">
        <div class="detail-card__header">
            <h2 class="mb-0">Detail Departemen</h2>
            <div class="d-flex gap-2">
                <a href="{{ route('departments.index') }}" class="btn btn-light btn-sm">← Kembali</a>
                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-outline-primary btn-sm">Edit</a>
            </div>
        </div>

        <table class="detail-table table table-striped">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $department->id }}</td>
                </tr>
                <tr>
                    <th>Nama Departemen</th>
                    <td>{{ $department->nama_departemen }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection