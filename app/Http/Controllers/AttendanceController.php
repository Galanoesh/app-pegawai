<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Tampilkan semua data absensi.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Form tambah absensi baru.
     */
    public function create()
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendances.create', compact('employees'));
    }

    /**
     * Simpan data absensi baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'karyawan_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date',
            'waktu_masuk'    => 'nullable|date_format:H:i',
            'waktu_keluar'   => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Attendance::create($data);

        return redirect()->route('attendances.index')->with('ok', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Detail satu data absensi.
     */
    public function show(Attendance $attendance)
    {
        $attendance->load('employee');
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Form edit absensi.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Update data absensi.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $data = $request->validate([
            'karyawan_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date',
            'waktu_masuk'    => 'nullable|date_format:H:i',
            'waktu_keluar'   => 'nullable|date_format:H:i',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($data);

        return redirect()->route('attendances.index')->with('ok', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Hapus data absensi.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('ok', 'Data absensi berhasil dihapus.');
    }
}
