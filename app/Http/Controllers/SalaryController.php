<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Tampilkan semua data gaji.
     */
    public function index()
    {
        $salaries = Salary::with('employee')->orderByDesc('id')->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    /**
     * Form tambah gaji.
     */
    public function create()
    {
        $employees = Employee::with('position')->orderBy('nama_lengkap')->get();
        return view('salaries.create', compact('employees'));
    }

    /**
     * Simpan data gaji baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|date_format:Y-m',
            'tunjangan'   => 'nullable|numeric|min:0',
            'potongan'    => 'nullable|numeric|min:0',
        ]);

        $employee = Employee::with('position')->findOrFail($data['karyawan_id']);
        $gajiPokok = (float) optional($employee->position)->gaji_pokok ?? 0.0;
        $tunjangan = (float) ($data['tunjangan'] ?? 0);
        $potongan  = (float) ($data['potongan'] ?? 0);
        $total     = $gajiPokok + $tunjangan - $potongan;

        Salary::create([
            'karyawan_id' => $employee->id,
            'bulan'       => $data['bulan'],
            'gaji_pokok'  => $gajiPokok,
            'tunjangan'   => $tunjangan,
            'potongan'    => $potongan,
            'total_gaji'  => $total,
        ]);

        return redirect()->route('salaries.index')->with('success', 'Data gaji tersimpan.');
    }
    /**
     * Detail satu data gaji.
     */
    public function show(Salary $salary)
    {
        $salary->load('employee');
        return view('salaries.show', compact('salary'));
    }

    /**
     * Form edit gaji.
     */
    public function edit(Salary $salary)
    {
        $employees = Employee::orderBy('nama_lengkap')->get();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Update data gaji.
     */
    public function update(Request $request, Salary $salary)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|date_format:Y-m',
            'gaji_pokok'  => 'required|numeric|min:0',
            'tunjangan'   => 'nullable|numeric|min:0',
            'potongan'    => 'nullable|numeric|min:0',
        ]);

        $validated['tunjangan']  = $validated['tunjangan'] ?? 0;
        $validated['potongan']   = $validated['potongan'] ?? 0;
        $validated['total_gaji'] = $validated['gaji_pokok'] + $validated['tunjangan'] - $validated['potongan'];

        $salary->update($validated);

        return redirect()->route('salaries.index')->with('ok', 'Data gaji berhasil diperbarui.');
    }

    /**
     * Hapus data gaji.
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('ok', 'Data gaji berhasil dihapus.');
    }
}
