@extends('siswa_user.layout')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #003b70 0%, #064b86 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 20px 40px rgba(0, 59, 112, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    .page-header h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
    }
    .page-header p {
        margin: 8px 0 0;
        opacity: 0.8;
        font-size: 16px;
    }
    .action-buttons {
        display: flex;
        gap: 12px;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    .btn-excel {
        background: #10b981;
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    .btn-excel:hover {
        background: #059669;
        transform: translateY(-2px);
        color: white;
    }
    .btn-print {
        background: white;
        color: #003b70;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .btn-print:hover {
        background: #f8fafc;
        transform: translateY(-2px);
        color: #003b70;
    }
    
    .grades-card {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(7, 55, 99, 0.05);
        border: 1px solid #f0f5fa;
    }
    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-custom th {
        background: #f8fafc;
        padding: 16px;
        font-weight: 800;
        color: #6f7b8a;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
    }
    .table-custom td {
        padding: 20px 16px;
        border-bottom: 1px solid #f0f5fa;
        vertical-align: middle;
    }
    .table-custom tr:last-child td {
        border-bottom: none;
    }
    .table-custom tr:hover td {
        background: #fcfdfe;
    }
    .grade-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 16px;
    }
    .grade-excellent { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
    .grade-good { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .grade-average { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
    .grade-poor { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
    
    .subject-name {
        font-weight: 800;
        color: #072d54;
        font-size: 16px;
        margin-bottom: 4px;
    }
    .type-badge {
        background: #f1f5f9;
        color: #64748b;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }
</style>

<div class="container">
    <div class="page-header">
        <div>
            <h1>🏆 Nilai Akademik</h1>
            <p>Pantau perkembangan dan hasil belajar kamu di sini.</p>
        </div>
        <div class="action-buttons">
            <a href="{{ route('siswa.nilai.export') }}" class="btn-action btn-excel">
                <i class="fa-solid fa-file-excel"></i> Download Excel
            </a>
            <a href="{{ route('siswa.nilai.cetak') }}" target="_blank" class="btn-action btn-print">
                <i class="fa-solid fa-print"></i> Cetak Nilai
            </a>
        </div>
    </div>

    <div class="grades-card">
        @if($nilai->count())
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th>Mata Pelajaran</th>
                            <th>Jenis Penilaian</th>
                            <th style="text-align: center;">Nilai Akhir</th>
                            <th>Keterangan / Catatan</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nilai as $index => $item)
                            <tr>
                                <td style="text-align: center; color: #94a3b8; font-weight: 700;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="subject-name">{{ $item->mapel->nama_mapel ?? '-' }}</div>
                                </td>
                                <td>
                                    <span class="type-badge">{{ $item->jenis_nilai }}</span>
                                </td>
                                <td style="text-align: center;">
                                    @php
                                        $n = (float) $item->nilai;
                                        $gradeClass = 'grade-poor';
                                        if($n >= 90) $gradeClass = 'grade-excellent';
                                        elseif($n >= 80) $gradeClass = 'grade-good';
                                        elseif($n >= 70) $gradeClass = 'grade-average';
                                    @endphp
                                    <div class="grade-badge {{ $gradeClass }}">
                                        {{ number_format($n, 0) }}
                                    </div>
                                </td>
                                <td style="color: #64748b; font-size: 14px; font-style: italic;">
                                    {{ $item->keterangan ?? 'Tidak ada catatan' }}
                                </td>
                                <td style="color: #94a3b8; font-size: 13px; font-weight: 600;">
                                    {{ $item->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px;">
                <img src="https://illustrations.popsy.co/blue/surreal-hourglass.svg" style="height: 180px; margin-bottom: 20px;">
                <h3 style="color: #072d54; font-weight: 800; font-size: 20px; margin-bottom: 10px;">Belum Ada Nilai</h3>
                <p style="color: #64748b; max-width: 400px; margin: 0 auto;">Gurumu belum memasukkan nilai tugas atau ujian apa pun. Terus semangat belajarnya ya!</p>
            </div>
        @endif
    </div>
</div>

@endsection
