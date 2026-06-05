@php
    $user = Auth::user();
    $unreadKonsultasi = 0;
    if($user && $user->level == 'guru') {
        $guru = \App\Models\Guru::where('id_user', $user->id)->first();
        if($guru) {
            $unreadKonsultasi = \App\Models\Konsultasi::where('id_guru', $guru->id)
                                    ->where('status', 'Menunggu')
                                    ->count();
        }
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bimbel Mentari - Guru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; font-family: 'Poppins', sans-serif; background: #eef3f8; color: #072d54; }
        a { text-decoration: none; color: inherit; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 280px; background: linear-gradient(180deg, #003b70, #064b86); color: white; padding: 32px 24px; display: flex; flex-direction: column; min-height: 100vh; }
        .menu { flex: 1; }
        .brand { display: flex; align-items: center; gap: 14px; margin-bottom: 40px; }
        .brand-logo { width: 62px; height: 62px; background: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .brand strong { display: block; font-size: 22px; font-weight: 800; line-height: 1.1; }
        .brand small { display: block; letter-spacing: 4px; font-size: 10px; font-weight: 700; opacity: 0.75; }
        .menu-title { font-size: 11px; letter-spacing: 2px; opacity: 0.8; margin-bottom: 14px; padding-left: 6px; }
        .menu a { display: flex; align-items: center; gap: 14px; padding: 14px 16px; border-radius: 16px; color: rgba(255,255,255,0.9); margin-bottom: 10px; font-weight: 600; transition: all 0.25s ease; position: relative; }
        .menu a:hover, .menu a.active { background: #ffc107; color: #073763; transform: translateX(3px); }
        .badge-nav { background: #dc3545; color: white; padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 800; margin-left: auto; }
        .logout { margin-top: 24px; width: 100%; border: 1px solid rgba(255, 255, 255, 0.18); background: rgba(255, 255, 255, 0.14); color: white; padding: 14px 18px; border-radius: 18px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.25s ease; display: inline-flex; align-items: center; justify-content: center; gap: 10px; }
        .logout:hover { background: rgba(255, 255, 255, 0.22); transform: translateX(2px); box-shadow: 0 14px 28px rgba(0, 0, 0, 0.12); }
        .content { flex: 1; padding: 32px; max-width: calc(100% - 280px); }
        .topbar { background: #fff; border-radius: 22px; padding: 26px 30px; display: flex; justify-content: space-between; align-items: center; gap: 20px; box-shadow: 0 20px 45px rgba(7, 55, 99, 0.08); margin-bottom: 28px; }
        .topbar h1 { margin: 0; font-size: 30px; font-weight: 800; color: #072d54; }
        .topbar p { margin: 6px 0 0; color: #5e6d81; font-size: 15px; }
        .badge { display: inline-flex; align-items: center; gap: 10px; background: #e9f7ef; color: #197f48; border-radius: 999px; padding: 10px 16px; font-weight: 800; font-size: 13px; }
        .card { background: #fff; border-radius: 24px; padding: 26px; box-shadow: 0 18px 40px rgba(7, 55, 99, 0.08); margin-bottom: 24px; }
        .grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; margin-bottom: 28px; }
        .stat { display: flex; justify-content: space-between; align-items: center; gap: 14px; min-height: 130px; }
        .stat h3 { margin: 0; font-size: 13px; color: #7a8596; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; }
        .stat strong { font-size: 30px; line-height: 1; color: #072d54; margin-top: 8px; }
        .stat-icon { width: 56px; height: 56px; border-radius: 18px; background: #fff4d4; color: #073763; display: flex; justify-content: center; align-items: center; font-size: 20px; }
        .section-title { font-size: 22px; font-weight: 800; margin-bottom: 18px; color: #072d54; }
        .table-responsive { width: 100%; overflow-x: auto; margin-top: 18px; }
        table { width: 100%; border-collapse: collapse; min-width: 620px; }
        table th, table td { padding: 16px 14px; border: 1px solid #e9eff4; text-align: left; vertical-align: middle; }
        table th { background: #f7fafc; color: #425069; font-weight: 700; }
        tbody tr:hover { background: #f8fbff; }
        .empty { display: block; color: #7b8490; background: #f8fafc; border-radius: 20px; padding: 22px; text-align: center; }
        
        /* Specific Dashboard Classes */
        .jadwal-item { border-bottom: 1px solid #e9eff4; padding: 18px 0; }
        .jadwal-item:last-child { border-bottom: none; }
        .tanggal { font-weight: 700; color: #072d54; margin-bottom: 6px; }
        .mapel { color: #003b70; font-weight: 700; margin-top: 4px; }
        .guru { color: #6f7b8a; margin-top: 4px; }
        .materi-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 22px; }
        .materi-card { background: #fff; border-radius: 24px; padding: 24px; box-shadow: 0 18px 40px rgba(7, 55, 99, 0.08); }
        .materi-icon { width: 52px; height: 52px; border-radius: 18px; background: #fff4d4; color: #073763; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 18px; }

        @media (max-width: 1020px) { .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .materi-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 860px) { .layout { flex-direction: column; } .sidebar { width: 100%; } .content { padding: 22px; max-width: 100%; } }
    </style>
</head>
<body>
<div class="layout">
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
            <div class="menu-title">MENU GURU</div>
            <a href="/guru-dashboard" class="{{ request()->is('guru-dashboard') ? 'active' : '' }}"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="/guru/jadwal" class="{{ request()->is('guru/jadwal') ? 'active' : '' }}"><i class="fa-solid fa-calendar-days"></i> Jadwal Mengajar</a>
            <a href="/guru/materi" class="{{ request()->is('guru/materi') ? 'active' : '' }}"><i class="fa-solid fa-book-open"></i> Materi</a>
            <a href="/guru/nilai" class="{{ request()->is('guru/nilai') ? 'active' : '' }}"><i class="fa-solid fa-file-lines"></i> Nilai Siswa</a>
            <a href="/guru/profil" class="{{ request()->is('guru/profil') ? 'active' : '' }}"><i class="fa-solid fa-user"></i> Profil</a>
            <a href="/guru/konsultasi" class="{{ request()->is('guru/konsultasi') ? 'active' : '' }}">
                <i class="fa-solid fa-comments"></i> Konsultasi Masuk
                @if($unreadKonsultasi > 0)
                    <span class="badge-nav">{{ $unreadKonsultasi }}</span>
                @endif
            </a>
            <a href="/guru/arsip-absensi" class="{{ request()->is('guru/arsip-absensi') ? 'active' : '' }}"><i class="fa-solid fa-box-archive"></i> Arsip Absensi</a>
            <form method="POST" action="/logout" id="logout-form">
                @csrf
                <button class="logout" type="button" onclick="confirmLogout(event)"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
            </form>

        </div>
    </aside>
    <main class="content">
        @yield('content')
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

    // Mengingat posisi scroll sidebar
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            const scrollPos = localStorage.getItem('sidebarScrollGuru');
            if (scrollPos) {
                sidebar.scrollTop = parseInt(scrollPos, 10);
            }
            window.addEventListener('beforeunload', function() {
                localStorage.setItem('sidebarScrollGuru', sidebar.scrollTop);
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