<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Tampilkan semua data departemen.
     */
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(10);
        return view('departments.index', compact('departments'));
    }

    /**
     * Tampilkan form tambah departemen baru.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Simpan data departemen baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen',
        ]);

        Department::create($validated);
        return redirect()->route('departments.index')->with('ok', 'Departemen berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail 1 departemen.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Tampilkan form edit departemen.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update data departemen.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $department->id,
        ]);

        $department->update($validated);
        return redirect()->route('departments.index')->with('ok', 'Departemen berhasil diperbarui.');
    }

    /**
     * Hapus data departemen.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('ok', 'Departemen berhasil dihapus.');
    }
}
