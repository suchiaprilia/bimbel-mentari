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
    .inbox-card {
        background: white;
        border-radius: 22px;
        border: 1px solid #e9eff4;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(7, 55, 99, 0.03);
        overflow: hidden;
    }
    .inbox-header {
        padding: 24px 30px;
        background: #f8fafc;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .inbox-body {
        padding: 30px;
    }
    .inbox-student {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .student-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #e3effd;
        color: #003b70;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 800;
    }
    .badge-waiting {
        background: #fff8e1;
        color: #b45309;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 800;
        border: 1px solid #fef3c7;
    }
    .badge-answered {
        background: #e9f7ef;
        color: #15803d;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 800;
        border: 1px solid #dcfce7;
    }
    .question-box {
        background: #f1f5f9;
        border-radius: 16px;
        padding: 20px;
        color: #334155;
        position: relative;
        margin-bottom: 20px;
        border-left: 4px solid #003b70;
    }
    .reply-area {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 2px dashed #e2e8f0;
    }
    .form-control {
        width: 100%;
        padding: 16px;
        border-radius: 14px;
        border: 1.5px solid #cbd5e1;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        resize: vertical;
        background: #fcfcfc;
        transition: 0.3s;
    }
    .form-control:focus {
        outline: none;
        border-color: #003b70;
        background: white;
        box-shadow: 0 0 0 4px rgba(0, 59, 112, 0.08);
    }
    .btn-reply {
        background: #003b70;
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-reply:hover {
        background: #064b86;
        transform: translateY(-1px);
    }
    .teacher-answer {
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        color: #166534;
        padding: 20px;
        border-radius: 16px;
    }
</style>

<div class="page-header">
    <div>
        <h1 style="margin: 0; font-size: 30px; font-weight: 800; color: white;">📬 Konsultasi Wali Murid</h1>
        <p style="margin: 5px 0 0; opacity: 0.8; font-size: 15px;">Jawab kekhawatiran & pertanyaan dari Orang Tua siswa Anda.</p>
    </div>
    <div style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 14px; font-weight: 700; backdrop-filter: blur(5px);">
        <i class="fa-solid fa-comment-dots mr-1"></i> Guru Channel
    </div>
</div>

@if(session('success'))
    <div style="background: #e9f7ef; color: #197f48; border: 1px solid #d1f2e0; padding: 15px 25px; border-radius: 18px; margin-bottom: 25px; font-weight: 700;">
        <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
    </div>
@endif

<h2 class="section-title">💬 Daftar Percakapan</h2>

@forelse($konsultasi as $k)
    <div class="inbox-card">
        <div class="inbox-header">
            <div class="inbox-student">
                <div class="student-avatar">
                    {{ strtoupper(substr($k->siswa->nama_siswa ?? 'S', 0, 1)) }}
                </div>
                <div>
                    <strong style="font-size: 16px; color: #072d54; display: block;">
                        {{ $k->siswa->nama_siswa ?? 'Siswa' }}
                        <span style="font-size: 10px; background: #e3f2fd; color: #0066cc; padding: 2px 8px; border-radius: 6px; margin-left: 6px; vertical-align: middle; border: 1px solid #bbdefb;"><i class="fa-solid fa-user-group" style="font-size: 9px; margin-right: 3px;"></i>Orang Tua</span>
                    </strong>
                    <span style="font-size: 13px; color: #64748b;">
                        Kelas: {{ $k->siswa->kelas->nama_kelas ?? '-' }}
                    </span>
                </div>
            </div>
            <div>
                @if($k->status == 'Menunggu')
                    <span class="badge-waiting"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Butuh Jawaban</span>
                @else
                    <span class="badge-answered"><i class="fa-solid fa-circle-check mr-1"></i> Sudah Dijawab</span>
                @endif
            </div>
        </div>

        <div class="inbox-body">
            {{-- TOPIK & PERTANYAAN --}}
            <div style="margin-bottom: 10px;">
                <span style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; font-weight: 800;">Topik Konsultasi:</span>
                <h3 style="margin: 4px 0 15px 0; color: #0f172a; font-weight: 800; font-size: 18px;">{{ $k->topik }}</h3>
            </div>

            <div class="question-box">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; font-weight: 600;">
                    <i class="fa-solid fa-user-tag"></i> Dikirim oleh Orang Tua • {{ $k->created_at->translatedFormat('d F Y, H:i') }}
                </div>
                <p style="margin: 0; line-height: 1.6; font-weight: 500;">{{ $k->pertanyaan }}</p>
            </div>

            {{-- JAWABAN --}}
            <div class="reply-area">
                @if($k->jawaban)
                    <div class="teacher-answer">
                        <div style="font-size: 12px; color: #15803d; margin-bottom: 8px; font-weight: 700;">
                            <i class="fa-solid fa-check-double"></i> Jawaban Anda Terkirim • {{ $k->updated_at->translatedFormat('d F Y, H:i') }}
                        </div>
                        <p style="margin: 0; line-height: 1.6; font-weight: 500;">{{ $k->jawaban }}</p>
                        
                        {{-- Opsi edit jawaban jika mau --}}
                        <div style="margin-top: 15px; border-top: 1px dashed rgba(21, 128, 61, 0.2); padding-top: 12px;">
                            <details>
                                <summary style="font-size: 12px; font-weight: 700; cursor: pointer; color: #003b70;">Koreksi/Ubah Jawaban Anda</summary>
                                <form action="/guru/konsultasi/{{ $k->id }}/balas" method="POST" style="margin-top: 10px;">
                                    @csrf
                                    <textarea name="jawaban" class="form-control" rows="3" required>{{ $k->jawaban }}</textarea>
                                    <button type="submit" class="btn-reply" style="margin-top: 10px; padding: 8px 20px; font-size: 13px;">Update Jawaban</button>
                                </form>
                            </details>
                        </div>
                    </div>
                @else
                    <div style="background: #fffcf5; border: 1px solid #fef3c7; padding: 20px; border-radius: 16px;">
                        <h4 style="margin: 0 0 12px 0; color: #b45309; font-weight: 700;"><i class="fa-solid fa-reply"></i> Berikan Tanggapan / Saran Anda</h4>
                        <form action="/guru/konsultasi/{{ $k->id }}/balas" method="POST">
                            @csrf
                            <textarea name="jawaban" class="form-control" rows="4" placeholder="Ketikkan solusi, masukan akademis, atau feedback untuk wali murid..." required></textarea>
                            
                            <div style="margin-top: 15px; text-align: right;">
                                <button type="submit" class="btn-reply">
                                    Kirim Jawaban <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@empty
    <div style="background: white; border-radius: 24px; padding: 70px 20px; text-align: center; border: 2px dashed #cbd5e1;">
        <i class="fa-solid fa-folder-open" style="font-size: 55px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
        <h3 style="margin: 0; color: #64748b; font-weight: 800;">Belum Ada Konsultasi Masuk</h3>
        <p style="color: #94a3b8; max-width: 400px; margin: 8px auto 0;">Kotak masuk Anda bersih. Pertanyaan dari wali murid mengenai mata pelajaran Anda akan muncul otomatis di sini.</p>
    </div>
@endforelse

@endsection
