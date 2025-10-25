<?php

namespace App\Http\Controllers;

use App\Models\Employee;   // Model utama pegawai
use App\Models\Department; // Untuk mengisi dropdown department
use App\Models\Position;   // Untuk mengisi dropdown position
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Tampilkan daftar pegawai.
     * - Memuat relasi department & position (eager loading) agar hemat query.
     */
    public function index()
    {
        // Ambil semua pegawai + relasinya (hindari N+1)
        $employees = Employee::with(['department', 'position'])->get();

        // Render ke view index
        return view('employees.index', compact('employees'));
    }

    /**
     * Tampilkan form tambah pegawai.
     * - Kirim daftar department & position untuk isi <select>.
     */
    public function create()
    {
        // Ambil daftar department dan position untuk dropdown (urutkan nama)
        $departments = Department::orderBy('nama_departemen', 'asc')->get(); // ganti kolom jika berbeda
        $positions   = Position::orderBy('nama_jabatan', 'asc')->get();      // ganti kolom jika berbeda

        // Render view create beserta data dropdown
        return view('employees.create', compact('departments', 'positions'));
    }

    /**
     * Simpan data pegawai baru.
     * - Validasi input (termasuk pastikan email unik).
     * - Pastikan departemen_id & jabatan_id valid (exists).
     */
    public function store(Request $request)
    {
        // Validasi semua field yang dibutuhkan
        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:employees,email',
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'status'         => 'required|string|in:aktif,nonaktif',
            'departemen_id'  => 'required|integer|exists:departments,id',
            'jabatan_id'     => 'required|integer|exists:positions,id',
        ]);

        // Simpan data hasil validasi
        Employee::create($validated);

        // Kembali ke index dengan pesan sukses
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu pegawai.
     */
    public function show(Employee $employee)
    {
        // Muat relasi jika belum dimuat
        $employee->loadMissing(['department', 'position']);

        // Render view detail
        return view('employees.show', compact('employee'));
    }

    /**
     * Tampilkan form edit pegawai.
     * - Kirim dropdown department & position untuk dipilih ulang.
     */
    public function edit(Employee $employee)
    {
        // Ambil pilihan dropdown
        $departments = Department::orderBy('nama_departemen', 'asc')->get(); // atau 'name'
        $positions   = Position::orderBy('nama_jabatan', 'asc')->get();      // atau 'name'

        // (Opsional) pastikan relasi tersedia untuk tampilan
        $employee->loadMissing(['department', 'position']);

        // Render view edit dengan data yang dibutuhkan
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Perbarui data pegawai yang ada.
     * - Validasi mirip store(), tapi email harus unique kecuali milik dirinya.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validasi update
        $request->validate([
            'nama_lengkap'   => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255', 'unique:employees,email,' . $employee->id],
            'nomor_telepon'  => ['required', 'string', 'max:20'],
            'tanggal_lahir'  => ['required', 'date'],
            'alamat'         => ['required', 'string', 'max:255'],
            'tanggal_masuk'  => ['required', 'date'],
            'status'         => ['required', 'in:aktif,nonaktif'],
            'departemen_id'  => ['required', 'integer', 'exists:departments,id'],
            'jabatan_id'     => ['required', 'integer', 'exists:positions,id'],
        ]);

        // Update hanya kolom yang diizinkan
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'tanggal_masuk',
            'alamat',
            'status',
            'departemen_id',
            'jabatan_id',
        ]));

        // Kembali ke index dengan pesan sukses
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    /**
     * Hapus data pegawai.
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
