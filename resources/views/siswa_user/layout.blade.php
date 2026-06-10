@php
    $user = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bimbel Mentari - Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #f4f7fa; color: #072d54; }
        a { text-decoration: none; color: inherit; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: linear-gradient(180deg, #003b70, #064b86); color: white; padding: 32px 24px; display: flex; flex-direction: column; min-height: 100vh; flex-shrink: 0; }
        .menu { flex: 1; }
        .brand { display: flex; align-items: center; gap: 14px; margin-bottom: 40px; }
        .brand-logo { width: 62px; height: 62px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .brand strong { display: block; font-size: 22px; font-weight: 800; line-height: 1.1; }
        .brand small { display: block; letter-spacing: 4px; font-size: 10px; font-weight: 700; opacity: 0.75; }
        .menu-title { font-size: 11px; letter-spacing: 2px; opacity: 0.8; margin-bottom: 14px; padding-left: 6px; text-transform: uppercase; }
        .menu a { display: flex; align-items: center; gap: 14px; padding: 14px 16px; border-radius: 16px; color: rgba(255,255,255,0.9); margin-bottom: 10px; font-weight: 600; transition: all 0.25s ease; }
        .menu a:hover, .menu a.active { background: #ffc107; color: #073763; transform: translateX(3px); }
        .logout { margin-top: 24px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.18); background: rgba(255, 255, 255, 0.14); color: white; padding: 14px 18px; border-radius: 18px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.25s ease; display: inline-flex; align-items: center; justify-content: center; gap: 10px; }
        .logout:hover { background: rgba(255, 255, 255, 0.22); transform: translateX(2px); }
        .content { flex: 1; padding: 40px; max-width: calc(100% - 280px); overflow-y: auto; }
        
        /* DASHBOARD STYLES */
        .card { background: #fff; border-radius: 24px; padding: 26px; box-shadow: 0 18px 40px rgba(7, 55, 99, 0.08); margin-bottom: 24px; }
        .grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; margin-bottom: 28px; }
        .stat { display: flex; justify-content: space-between; align-items: center; gap: 14px; min-height: 130px; }
        .stat h3 { margin: 0; font-size: 13px; color: #7a8596; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; }
        .stat strong { font-size: 30px; line-height: 1; color: #072d54; margin-top: 8px; }
        .stat-icon { width: 56px; height: 56px; border-radius: 18px; background: #fff4d4; color: #073763; display: flex; justify-content: center; align-items: center; font-size: 20px; }
        .section-title { font-size: 22px; font-weight: 800; margin-bottom: 18px; color: #072d54; }

        /* PARENT MODE STYLES */
        .btn-switch { display: flex; align-items: center; justify-content: center; gap: 10px; background: #ffc107; color: #073763; padding: 12px; border-radius: 14px; font-size: 13px; font-weight: 800; cursor: pointer; transition: all 0.3s; width: 100%; border: none; margin-top: 10px; }
        .btn-switch.parent-active { background: #28a745; color: white; }
        .btn-switch:hover { transform: scale(1.02); opacity: 0.9; }

        @media (max-width: 1020px) { .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .sidebar { width: 240px; } }
        @media (max-width: 860px) { .layout { flex-direction: column; } .sidebar { width: 100%; min-height: auto; padding: 20px; } .content { padding: 20px; max-width: 100%; } }
    </style>
</head>
<body>

<div class="layout">

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; padding: 2px;">
            </div>
            <div>
                <small>BIMBEL</small>
                <strong>MENTARI</strong>
            </div>
        </div>

        <div class="menu">
            <div class="menu-title">MENU SISWA</div>
            <a href="/siswa-dashboard" class="{{ request()->is('siswa-dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="/siswa/jadwal" class="{{ request()->is('siswa/jadwal') ? 'active' : '' }}"><i class="fa-solid fa-calendar-days"></i> Jadwal Belajar</a>
            <a href="/siswa/materi" class="{{ request()->is('siswa/materi') ? 'active' : '' }}"><i class="fa-solid fa-book-open"></i> Materi</a>
            <a href="/siswa/nilai" class="{{ request()->is('siswa/nilai') ? 'active' : '' }}"><i class="fa-solid fa-graduation-cap"></i> Nilai</a>
            <a href="/siswa/pembayaran" class="{{ request()->is('siswa/pembayaran') ? 'active' : '' }}"><i class="fa-solid fa-money-bill-wave"></i> Pembayaran</a>
            <a href="/siswa/profil" class="{{ request()->is('siswa/profil') ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Profil Saya</a>

            @if (session('is_parent_mode') || session('parent_mode'))
                @php
                    $unreadBalasan = 0;
                    $user = Auth::user();
                    if($user && $user->level == 'siswa') {
                        $siswaUser = \App\Models\Siswa::where('id_user', $user->id)->first();
                        if($siswaUser) {
                            $unreadBalasan = \App\Models\Konsultasi::where('id_siswa', $siswaUser->id)
                                                ->where('status', 'Dijawab')
                                                ->where('is_read_siswa', false)
                                                ->count();
                        }
                    }
                @endphp
                <a href="/siswa/parent/konsultasi" class="{{ request()->is('siswa/parent/konsultasi') ? 'active' : '' }}" style="display: flex; justify-content: space-between; align-items: center;">
                    <span><i class="fa-solid fa-comments"></i> Konsultasi Guru</span>
                    @if($unreadBalasan > 0)
                        <span style="background: #ef4444; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: bold;">{{ $unreadBalasan }}</span>
                    @endif
                </a>
            @endif

            <div style="margin-top: 20px;">
                @if (session('is_parent_mode'))
                    <a href="{{ route('siswa.toggle-parent') }}" class="btn-switch parent-active"><i class="fa-solid fa-user-check"></i> <span>Mode Orang Tua: ON</span></a>
                @else
                    <a href="#" onclick="promptPin(event)" class="btn-switch"><i class="fa-solid fa-user-group"></i> <span>Akses Orang Tua</span></a>
                @endif
            </div>

            <form method="POST" action="/logout" id="logout-form">
                @csrf
                <button class="logout" type="button" onclick="confirmLogout(event)"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
            </form>

        </div>
    </aside>

    <main class="content">
        @yield('content')
        @yield('konten')
    </main>

</div>

<script>
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: "Apakah Anda yakin ingin keluar dari aplikasi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#003b70',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
            borderRadius: '16px'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    function promptPin(e) {
        e.preventDefault();
        let pin = prompt("🔐 Keamanan Orang Tua\n\nMasukkan PIN Anda untuk melanjutkan.\n(Petunjuk: PIN adalah 4 digit terakhir nomor WhatsApp yang terdaftar)");
        if (pin) {
            window.location.href = "{{ route('siswa.toggle-parent') }}?pin=" + pin;
        }
    }

    // Mengingat posisi scroll sidebar
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            const scrollPos = localStorage.getItem('sidebarScrollSiswa');
            if (scrollPos) {
                sidebar.scrollTop = parseInt(scrollPos, 10);
            }
            window.addEventListener('beforeunload', function() {
                localStorage.setItem('sidebarScrollSiswa', sidebar.scrollTop);
            });
        }
    });

    // form-delete
    document.querySelectorAll('.form-delete').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const nama = form.getAttribute('data-nama') || 'data ini';
            Swal.fire({
                title: 'Hapus ' + nama + '?',
                text: 'Data yang dihapus tidak bisa dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // form-confirm dynamic
    document.querySelectorAll('.form-confirm').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: form.getAttribute('data-title') || 'Konfirmasi',
                text: form.getAttribute('data-text') || 'Apakah Anda yakin?',
                icon: form.getAttribute('data-icon') || 'question',
                showCancelButton: true,
                confirmButtonColor: form.getAttribute('data-color') || '#003b70',
                cancelButtonColor: '#6c757d',
                confirmButtonText: form.getAttribute('data-btn') || 'Ya, Lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
</body>

</html>