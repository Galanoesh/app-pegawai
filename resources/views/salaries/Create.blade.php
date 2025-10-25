@extends('master')
@section('title', 'Tambah Gaji')

@section('content')
<div class="container mt-5">
    <div class="form-card">
        <div class="form-card__header">
            <h2 class="mb-0">Form Gaji</h2>
            <a href="{{ route('salaries.index') }}" class="btn btn-light btn-sm">← Kembali</a>
        </div>

        {{-- Error global (opsional) --}}
        @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0" style="padding-left:18px;">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('salaries.store') }}" method="POST" novalidate>
            @csrf

            {{-- karyawan_id --}}
            <div class="form-group">
                <label>Karyawan</label>
                <select id="karyawanSelect" name="karyawan_id"
                    class="form-control @error('karyawan_id') is-invalid @enderror" required>
                    <option value="">— Pilih Karyawan —</option>
                    @foreach($employees as $e)
                    <option value="{{ $e->id }}"
                        data-gaji="{{ (float) optional($e->position)->gaji_pokok }}"
                        {{ old('karyawan_id')==$e->id ? 'selected' : '' }}>
                        {{ $e->nama_lengkap }}
                        @if(optional($e->position)->nama_jabatan ?? optional($e->position)->name)
                        — {{ optional($e->position)->nama_jabatan ?? optional($e->position)->name }}
                        @endif
                    </option>
                    @endforeach
                </select>
                @error('karyawan_id') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- bulan --}}
            <div class="form-group">
                <label>Bulan</label>
                <input type="month" name="bulan" value="{{ old('bulan') }}"
                    class="form-control @error('bulan') is-invalid @enderror" required>
                @error('bulan') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- gaji_pokok (readonly, auto dari posisi) --}}
            <div class="form-group">
                <label>Gaji Pokok</label>
                <input id="gajiPokokInput" type="number" step="0.01" min="0"
                    name="gaji_pokok"
                    value="{{ old('gaji_pokok') }}" {{-- akan dioverride JS saat pilih karyawan --}}
                    class="form-control @error('gaji_pokok') is-invalid @enderror" readonly>
                @error('gaji_pokok') <small class="invalid-feedback">{{ $message }}</small> @enderror
                <small class="text-muted">Diambil otomatis dari posisi karyawan.</small>
            </div>

            {{-- tunjangan --}}
            <div class="form-group">
                <label>Tunjangan</label>
                <input type="number" step="0.01" min="0"
                    name="tunjangan" value="{{ old('tunjangan', 0) }}"
                    class="form-control @error('tunjangan') is-invalid @enderror">
                @error('tunjangan') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- potongan --}}
            <div class="form-group">
                <label>Potongan</label>
                <input type="number" step="0.01" min="0"
                    name="potongan" value="{{ old('potongan', 0) }}"
                    class="form-control @error('potongan') is-invalid @enderror">
                @error('potongan') <small class="invalid-feedback">{{ $message }}</small> @enderror
            </div>

            {{-- total_gaji (auto hitung) --}}
            <div class="form-group">
                <label>Total Gaji</label>
                <input id="totalGajiInput" type="number" step="0.01" min="0"
                    name="total_gaji" value="{{ old('total_gaji') }}"
                    class="form-control @error('total_gaji') is-invalid @enderror" readonly>
                @error('total_gaji') <small class="invalid-feedback">{{ $message }}</small> @enderror
                <small class="text-muted">Otomatis: gaji pokok + tunjangan − potongan.</small>
            </div>

            <div class="form-actions">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('salaries.index') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </div>
</div>

{{-- Auto-set gaji pokok & auto-calc total --}}
<script>
    (function() {
        const sel = document.getElementById('karyawanSelect'); // NEW
        const gp = document.getElementById('gajiPokokInput'); // NEW
        const tj = document.querySelector('input[name="tunjangan"]');
        const pt = document.querySelector('input[name="potongan"]');
        const tg = document.getElementById('totalGajiInput'); // NEW

        function toNum(v) {
            return parseFloat(v || '0');
        }

        function setGajiPokokFromSelect() { // NEW
            const opt = sel && sel.options[sel.selectedIndex];
            const gaji = opt ? parseFloat(opt.getAttribute('data-gaji') || '0') : 0;
            gp.value = Number.isFinite(gaji) ? gaji.toFixed(2) : '0.00';
            calc(); // setiap set gaji, langsung hitung total
        }

        function calc() {
            const total = toNum(gp.value) + toNum(tj.value) - toNum(pt.value);
            tg.value = (Number.isFinite(total) ? total : 0).toFixed(2);
        }

        // events
        if (sel) sel.addEventListener('change', setGajiPokokFromSelect); // NEW
        [tj, pt].forEach(el => el && el.addEventListener('input', calc));

        // init saat halaman dibuka: apply old selection atau default kosong
        setGajiPokokFromSelect(); // NEW
    })();
</script>
@endsection