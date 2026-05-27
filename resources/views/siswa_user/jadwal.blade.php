@extends('siswa_user.layout')

@section('content')

<style>
    .schedule-header {
        background: linear-gradient(135deg, #003b70 0%, #064b86 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 59, 112, 0.15);
    }
    .schedule-header::after {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }
    .date-badge {
        display: inline-block;
        padding: 10px 24px;
        background: #fff;
        color: #003b70;
        border-radius: 100px;
        font-weight: 800;
        font-size: 14px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }
    .schedule-card {
        background: #ffffff;
        border: 1px solid #f0f5fa;
        border-radius: 24px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }
    .schedule-card:hover {
        transform: translateY(-5px) scale(1.01);
        box-shadow: 0 20px 40px rgba(7, 55, 99, 0.08);
        border-color: #e3f2fd;
    }
    .time-slot {
        background: #f8fbff;
        padding: 15px;
        border-radius: 18px;
        min-width: 120px;
        text-align: center;
        border: 1px solid #e3f2fd;
    }
    .time-slot strong {
        display: block;
        color: #003b70;
        font-size: 16px;
    }
    .time-slot span {
        font-size: 11px;
        color: #6f7b8a;
        font-weight: 600;
        text-transform: uppercase;
    }
    .subject-info {
        flex: 1;
    }
    .subject-info h3 {
        margin: 0 0 5px;
        font-size: 20px;
        font-weight: 800;
        color: #072d54;
    }
    .guru-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #f1f5fa;
        padding: 6px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
        color: #5e6d81;
    }
    .guru-pill i {
        color: #ffc107;
    }
    .btn-back-new {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        backdrop-filter: blur(10px);
        transition: 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .btn-back-new:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
    }
</style>

<div class="container">

    <div class="schedule-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0; font-size: 32px; font-weight: 800;">Jadwal Belajar</h1>
                <p style="margin: 8px 0 0; opacity: 0.8; font-size: 16px;">Semangat belajarnya hari ini, Mentari!</p>
            </div>
            <a href="/siswa-dashboard" class="btn-back-new">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>

    @if($siswa && $siswa->kelas && $siswa->kelas->jadwal->count())

        @php
            $groupedJadwal = $siswa->kelas->jadwal->sortBy('tanggal')->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->tanggal)->format('Y-m-d');
            });
        @endphp

        @foreach($groupedJadwal as $date => $jadwals)
            <div class="date-section">
                <div class="date-badge">
                    <i class="fa-regular fa-calendar-check mr-2"></i> {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                </div>

                <div class="schedule-list">
                    @foreach($jadwals as $j)
                        <div class="schedule-card">
                            <div class="time-slot">
                                <span>Waktu</span>
                                <strong>{{ $j->jam_mulai }}</strong>
                                <small style="font-size: 10px; color: #adb5bd; font-weight: 700;">Sampai {{ $j->jam_selesai }}</small>
                            </div>

                            <div class="subject-info">
                                <h3>{{ $j->mapel->nama_mapel ?? '-' }}</h3>
                                <div class="guru-pill">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span>Guru: {{ $j->guru->nama_guru ?? '-' }}</span>
                                </div>
                            </div>

                            <div style="text-align: right;">
                                <div style="width: 45px; height: 45px; background: #fff4d4; color: #ffc107; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    @else
        <div class="card text-center" style="padding: 80px 40px; border-radius: 32px;">
            <div style="width: 120px; height: 120px; background: #f0f7ff; color: #0066cc; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 50px; margin: 0 auto 30px;">
                <i class="fa-solid fa-calendar-xmark"></i>
            </div>
            <h2 style="font-weight: 800; color: #072d54;">Belum Ada Jadwal</h2>
            <p style="color: #6f7b8a; max-width: 400px; margin: 0 auto;">Saat ini belum ada jadwal belajar yang terdaftar untuk kelasmu. Silakan hubungi admin atau cek kembali nanti.</p>
        </div>
    @endif

</div>

@endsection