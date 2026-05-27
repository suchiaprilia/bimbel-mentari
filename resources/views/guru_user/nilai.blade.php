@extends('guru_user.layout')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #003b70 0%, #064b86 100%);
        border-radius: 24px;
        padding: 35px 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 20px 45px rgba(7, 55, 99, 0.12);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .filter-card {
        background: #fff;
        border-radius: 22px;
        padding: 25px;
        box-shadow: 0 15px 35px rgba(7, 55, 99, 0.05);
        border: 1px solid #f0f5fa;
        margin-bottom: 25px;
    }
    .btn-premium {
        background: #ffc107;
        color: #073763;
        border: none;
        padding: 12px 25px;
        border-radius: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-premium:hover {
        background: #ffca2c;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }
    .btn-save {
        background: #003b70;
        color: white;
        padding: 15px 40px;
        border-radius: 16px;
        font-weight: 800;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 10px 25px rgba(0, 59, 112, 0.2);
    }
    .btn-save:hover {
        background: #064b86;
        transform: scale(1.02);
    }
    .input-nilai {
        border: 1.5px solid #e3e9ef !important;
        border-radius: 10px !important;
        padding: 8px 12px !important;
        text-align: center;
        font-weight: 700;
        width: 80px;
        transition: 0.2s;
    }
    .input-nilai:focus {
        border-color: #ffc107 !important;
        background: #fffdf5 !important;
        outline: none;
    }
    .input-ket {
        border: 1.5px solid #e3e9ef !important;
        border-radius: 10px !important;
        padding: 8px 12px !important;
        width: 100%;
    }
</style>

<div class="page-header">
    <div>
        <h1 style="margin: 0; font-size: 30px; font-weight: 800;">📝 Input Nilai Siswa</h1>
        <p style="margin: 5px 0 0; opacity: 0.8; font-size: 15px;">Berikan apresiasi terbaik untuk hasil belajar siswamu.</p>
    </div>
    <div style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 14px; font-weight: 700; backdrop-filter: blur(5px);">
        <i class="fa-solid fa-user-tie mr-2"></i> Guru Dashboard
    </div>
</div>

@if(session('success'))
    <div class="card" style="background: #e9f7ef; color: #197f48; border: 1px solid #d1f2e0; padding: 15px 25px; border-radius: 18px; margin-bottom: 25px; font-weight: 700;">
        <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
    </div>
@endif

<div class="filter-card">
    <form method="GET" action="/guru/nilai">
        <div style="display: flex; align-items: flex-end; gap: 20px; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <label style="display: block; font-weight: 800; color: #7b8490; font-size: 12px; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 1px;">Pilih Jadwal Mengajar</label>
                <select name="jadwal_id" style="width: 100%; padding: 14px; border-radius: 14px; border: 1px solid #d8e0ea; background: #f8fafc; color: #072d54; font-weight: 600;">
                    <option value="">-- Klik untuk memilih jadwal --</option>
                    @foreach($jadwal as $item)
                        <option value="{{ $item->id_jadwal }}" {{ request('jadwal_id') == $item->id_jadwal ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }} | {{ $item->jam_mulai }} - {{ $item->jam_selesai }} | {{ $item->mapel->nama_mapel ?? '-' }} (Kelas {{ $item->kelas->nama_kelas ?? '-' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-premium">
                <i class="fa-solid fa-users-viewfinder"></i> Tampilkan Siswa
            </button>
        </div>
    </form>
</div>

@if($selectedJadwal)
    <div class="card" style="padding: 0; overflow: hidden; border-radius: 28px;">
        <div style="background: #f8fbff; padding: 25px 35px; border-bottom: 1px solid #edf2f7;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h2 style="margin: 0; font-size: 20px; font-weight: 800; color: #072d54;">
                        {{ $selectedJadwal->mapel->nama_mapel ?? '-' }} - Kelas {{ $selectedJadwal->kelas->nama_kelas ?? '-' }}
                    </h2>
                    <p style="margin: 5px 0 0; color: #6f7b8a; font-size: 14px; font-weight: 600;">
                        <i class="fa-solid fa-calendar-day mr-1"></i> {{ \Carbon\Carbon::parse($selectedJadwal->tanggal)->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                <div style="display: flex; gap: 10px; align-items: center; justify-content: flex-end;">
                    <a href="{{ route('guru.nilai.template', ['jadwal_id' => $selectedJadwal->id_jadwal]) }}" class="btn" style="background: #10b981; color: white; padding: 8px 15px; border-radius: 12px; text-decoration: none; font-size: 13px; font-weight: bold;"><i class="fa-solid fa-download"></i> Template Excel</a>
                    <button type="button" onclick="document.getElementById('modalExcel').style.display='flex'" style="background: #4f46e5; border: none; color: white; padding: 8px 15px; border-radius: 12px; cursor: pointer; font-size: 13px; font-weight: bold;"><i class="fa-solid fa-upload"></i> Upload Excel</button>
                    <span style="background: #fff; padding: 8px 15px; border-radius: 12px; border: 1px solid #e3e9ef; font-size: 13px; font-weight: 700; color: #003b70;">
                        {{ $siswa->count() }} Siswa
                    </span>
                </div>
            </div>
        </div>

        <div style="padding: 35px;">
            <form method="POST" action="/guru/nilai/store">
                @csrf
                <input type="hidden" name="jadwal_id" value="{{ $selectedJadwal->id_jadwal }}">

                <div style="max-width: 400px; margin-bottom: 30px;">
                    <label style="display: block; font-weight: 800; color: #7b8490; font-size: 12px; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 1px;">Jenis Penilaian</label>
                    <input type="text" name="jenis_nilai" value="{{ old('jenis_nilai') }}" 
                           placeholder="Contoh: Ulangan Harian 1, Tugas Akhir, Kuis" 
                           style="width: 100%; padding: 14px; border-radius: 14px; border: 1px solid #d8e0ea; background: #f8fafc;" required>
                </div>

                <div class="table-responsive">
                    <table class="table-custom">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 60px; text-align: center;">No</th>
                                <th>Nama Siswa</th>
                                <th style="width: 120px; text-align: center;">Skor Nilai</th>
                                <th>Catatan / Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($siswa as $index => $item)
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: #7b8490;">{{ $index + 1 }}</td>
                                <td style="font-weight: 800; color: #072d54;">{{ $item->nama_siswa }}</td>
                                <td style="text-align: center;">
                                    <input type="number" name="nilai[{{ $item->id }}]" value="{{ old('nilai.' . $item->id) }}"
                                           min="0" max="100" step="0.01" class="input-nilai" placeholder="0">
                                </td>
                                <td>
                                    <input type="text" name="keterangan[{{ $item->id }}]" value="{{ old('keterangan.' . $item->id) }}"
                                           class="input-ket" placeholder="Opsional...">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">Tidak ada data siswa untuk kelas ini.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 30px; text-align: right;">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Semua Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>
@else
    <div class="card" style="text-align: center; padding: 60px 20px; border-radius: 32px;">
        <img src="https://illustrations.popsy.co/blue/manager.svg" style="height: 180px; margin-bottom: 25px;">
        <h3 style="color: #072d54; font-weight: 800;">Pilih Jadwal Terlebih Dahulu</h3>
        <p style="color: #6f7b8a; max-width: 450px; margin: 0 auto;">Silakan pilih jadwal mengajar pada filter di atas untuk mulai memasukkan nilai hasil belajar siswa Anda.</p>
    </div>
@endif

{{-- ============================================================ --}}
{{-- SECTION RIWAYAT NILAI (TAMBAHAN BARU) --}}
{{-- ============================================================ --}}
@if($selectedJadwal && $riwayatNilai->count() > 0)
<div style="margin-top: 30px;">
    <div class="card" style="padding: 0; overflow: hidden; border-radius: 28px;">
        <div style="background: linear-gradient(135deg, #003b70 0%, #064b86 100%); padding: 22px 35px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="margin: 0; font-size: 18px; font-weight: 800; color: white;">
                    📋 Riwayat Penilaian
                </h2>
                <p style="margin: 4px 0 0; color: rgba(255,255,255,0.75); font-size: 13px;">
                    Semua nilai yang sudah pernah diinput untuk jadwal ini
                </p>
            </div>
            <span style="background: rgba(255,255,255,0.2); color: white; padding: 8px 16px; border-radius: 12px; font-size: 13px; font-weight: 700;">
                {{ $riwayatNilai->count() }} Entri
            </span>
        </div>

        <div style="padding: 0 35px 35px;">
            @php $grouped = $riwayatNilai->groupBy('jenis_nilai'); @endphp

            @foreach($grouped as $jenis => $entries)
            <div style="margin-top: 28px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <span style="background: #e8f0fb; color: #003b70; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 800; border: 1px solid #c8d9f5;">
                        {{ $jenis }}
                    </span>
                    <span style="color: #9aa5b4; font-size: 12px;">
                        {{ $entries->first()->created_at->translatedFormat('d F Y, H:i') }}
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table-custom" style="font-size: 14px;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="width: 50px; text-align: center;">No</th>
                                <th>Nama Siswa</th>
                                <th style="width: 100px; text-align: center;">Nilai</th>
                                <th>Keterangan</th>
                                <th style="width: 110px; text-align: center;">Tanggal</th>
                                <th style="width: 90px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($entries as $idx => $r)
                            <tr>
                                <td style="text-align: center; color: #9aa5b4; font-weight: 700;">{{ $idx + 1 }}</td>
                                <td style="font-weight: 700; color: #072d54;">{{ $r->siswa->nama_siswa ?? '-' }}</td>
                                <td style="text-align: center;">
                                    @php $n = (float) $r->nilai; @endphp
                                    <span style="
                                        display: inline-block;
                                        padding: 4px 14px;
                                        border-radius: 20px;
                                        font-weight: 800;
                                        font-size: 14px;
                                        background: {{ $n >= 80 ? '#ecfdf5' : ($n >= 60 ? '#fffbeb' : '#fee2e2') }};
                                        color: {{ $n >= 80 ? '#059669' : ($n >= 60 ? '#d97706' : '#dc2626') }};
                                        border: 1px solid {{ $n >= 80 ? '#a7f3d0' : ($n >= 60 ? '#fde68a' : '#fecaca') }};
                                    ">{{ number_format($n, 0) }}</span>
                                </td>
                                <td style="color: #6f7b8a; font-size: 13px;">{{ $r->keterangan ?? '-' }}</td>
                                <td style="text-align: center; color: #9aa5b4; font-size: 12px;">
                                    {{ $r->created_at->format('d M Y') }}
                                </td>
                                <td style="text-align: center;">
                                    <a href="/guru/nilai/delete/{{ $r->id }}"
                                       onclick="return confirm('Hapus nilai ini?')"
                                       style="display:inline-flex;align-items:center;gap:5px;background:#fee2e2;color:#dc2626;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;transition:0.2s;"
                                       onmouseover="this.style.background='#fecaca'"
                                       onmouseout="this.style.background='#fee2e2'">
                                        <i class="fa-solid fa-trash-can"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@elseif($selectedJadwal && $riwayatNilai->count() === 0)
<div style="margin-top: 25px;">
    <div class="card" style="text-align: center; padding: 35px 20px; border-radius: 22px; background: #f8fafc; border: 2px dashed #d8e0ea;">
        <i class="fa-solid fa-clock-rotate-left" style="font-size: 36px; color: #c8d6e5; margin-bottom: 14px; display: block;"></i>
        <p style="color: #9aa5b4; font-weight: 700; margin: 0; font-size: 14px;">Belum ada riwayat penilaian untuk jadwal ini.</p>
    </div>
</div>
@endif

<!-- Modal Upload Excel -->
<div id="modalExcel" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 30px; border-radius: 20px; width: 400px; max-width: 90%;">
        <h3 style="margin-top:0; color:#072d54;">Upload Nilai Excel</h3>
        <p style="color:#6f7b8a; font-size:14px;">Pastikan Anda sudah menggunakan format dari <strong>Template Excel</strong> yang diunduh.</p>
        <form method="POST" action="{{ route('guru.nilai.import') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jadwal_id" value="{{ $selectedJadwal->id_jadwal ?? '' }}">
            <div style="margin-bottom:15px;">
                <label style="display:block; font-weight:bold; font-size:12px; color:#7b8490; margin-bottom:5px;">Jenis Penilaian</label>
                <input type="text" name="jenis_nilai" required placeholder="Contoh: UTS, Tugas Harian" style="width:100%; padding:10px; border:1px solid #d8e0ea; border-radius:10px; box-sizing: border-box;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block; font-weight:bold; font-size:12px; color:#7b8490; margin-bottom:5px;">File Excel (.xlsx)</label>
                <input type="file" name="file_excel" accept=".xlsx,.csv" required style="width:100%; padding:10px; border:1px solid #d8e0ea; border-radius:10px; box-sizing: border-box;">
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" onclick="document.getElementById('modalExcel').style.display='none'" style="padding:10px 15px; border:none; background:#e3e9ef; color:#4a5568; border-radius:10px; font-weight:bold; cursor:pointer;">Batal</button>
                <button type="submit" style="padding:10px 15px; border:none; background:#003b70; color:white; border-radius:10px; font-weight:bold; cursor:pointer;">Upload & Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
