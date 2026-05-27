@extends('siswa_user.layout')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #003b70 0%, #064b86 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 59, 112, 0.15);
    }
    .materi-card {
        background: #ffffff;
        border: 1px solid #f0f5fa;
        border-radius: 28px;
        padding: 0;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .materi-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(7, 55, 99, 0.1);
        border-color: #e3f2fd;
    }
    .materi-icon-wrapper {
        background: #f8fbff;
        padding: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 40px;
        color: #0066cc;
        border-bottom: 1px solid #f0f5fa;
    }
    .materi-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .materi-body h3 {
        margin: 0 0 10px;
        font-size: 20px;
        font-weight: 800;
        color: #072d54;
    }
    .materi-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        color: #6f7b8a;
        font-weight: 600;
    }
    .btn-download-premium {
        background: #ffc107;
        color: #073763;
        padding: 14px;
        border-radius: 16px;
        font-weight: 800;
        text-align: center;
        text-decoration: none;
        transition: 0.3s;
        display: block;
        margin-top: auto;
    }
    .btn-download-premium:hover {
        background: #ffca2c;
        transform: scale(1.02);
        color: #073763;
    }
</style>

<div class="container">

    <div class="page-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0; font-size: 32px; font-weight: 800;">Materi Belajar</h1>
                <p style="margin: 8px 0 0; opacity: 0.8; font-size: 16px;">Perdalam pemahamanmu dengan materi pilihan.</p>
            </div>
            <a href="/siswa-dashboard" style="background: rgba(255, 255, 255, 0.15); color: white; padding: 10px 20px; border-radius: 12px; font-weight: 700; text-decoration: none; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>

    <div class="row">
        @forelse($materi as $m)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="materi-card">
                    <div class="materi-icon-wrapper">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <div class="materi-body">
                        <span style="font-size: 11px; font-weight: 800; color: #0066cc; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">
                            {{ $m->mapel->nama_mapel ?? 'Umum' }}
                        </span>
                        <h3>{{ $m->judul_materi }}</h3>
                        <div class="materi-meta">
                            <i class="fa-solid fa-user-tie"></i>
                            <span>{{ $m->guru->nama_guru ?? '-' }}</span>
                        </div>
                        
                        @if($m->file_materi)
                            <div style="display: flex; gap: 10px; margin-top: auto;">
                                <a href="{{ asset('storage/' . $m->file_materi) }}" target="_blank" class="btn-download-premium" style="flex: 1; background: #e3f2fd; color: #0066cc;">
                                    <i class="fa-solid fa-eye"></i> Preview
                                </a>
                                <a href="{{ asset('storage/' . $m->file_materi) }}" download class="btn-download-premium" style="flex: 1;">
                                    <i class="fa-solid fa-download"></i> Unduh
                                </a>
                            </div>
                        @else
                            <div style="text-align: center; padding: 14px; background: #f8fafc; border-radius: 16px; color: #adb5bd; font-weight: 700; font-size: 14px;">
                                Belum ada file
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center" style="padding: 60px 20px;">
                <img src="https://illustrations.popsy.co/blue/reading-book.svg" style="height: 200px; margin-bottom: 20px;">
                <h3 style="color: #072d54; font-weight: 800;">Materi Belum Tersedia</h3>
                <p style="color: #6f7b8a;">Sabar ya, gurumu sedang menyiapkan materi terbaik untukmu.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection