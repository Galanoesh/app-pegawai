<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Tampilkan daftar jabatan.
     */
    public function index()
    {
        $positions = Position::orderBy('id', 'desc')->paginate(10);
        return view('positions.index', compact('positions'));
    }

    /**
     * Form tambah jabatan.
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Simpan jabatan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan',
            'gaji_pokok'   => 'required|numeric|min:0',
        ]);

        Position::create($validated);

        return redirect()->route('positions.index')->with('ok', 'Jabatan berhasil ditambahkan.');
    }

    /**
     * Detail jabatan.
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Form edit jabatan.
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Update jabatan.
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok'   => 'required|numeric|min:0',
        ]);

        $position->update($validated);

        return redirect()->route('positions.index')->with('ok', 'Jabatan berhasil diperbarui.');
    }

    /**
     * Hapus jabatan.
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index')->with('ok', 'Jabatan berhasil dihapus.');
    }
}
