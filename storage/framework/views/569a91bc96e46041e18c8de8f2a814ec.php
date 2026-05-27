<?php
    $user = Auth::user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('judul', 'Admin Dashboard'); ?> | Bimbel Mentari</title>
    
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f7fa;
            color: #334155;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: #003b70;
            padding: 30px 20px;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
            padding: 0 10px;
        }

        .brand-logo {
            width: 62px;
            height: 62px;
            background: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .brand strong {
            font-size: 20px;
            letter-spacing: 1px;
            display: block;
            line-height: 1.2;
        }

        .brand small {
            opacity: 0.7;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* MENU */
        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            margin: 25px 0 15px 15px;
            font-weight: 700;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            color: rgba(255,255,255,0.9);
            margin-bottom: 6px;
            font-weight: 600;
            transition: all 0.25s ease;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #ffc107;
            color: #073763;
            transform: translateX(3px);
        }

        .logout {
            margin-top: 24px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.14);
            color: white;
            padding: 14px 18px;
            border-radius: 18px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logout:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateX(2px);
        }

        .main-content {
            flex: 1;
            padding: 32px;
            margin-left: 280px;
            width: calc(100% - 280px);
        }

        /* CARD STYLES */
        .card {
            border-radius: 24px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .card-header {
            background-color: white;
            padding: 25px 30px;
            border-bottom: 1px solid #f1f5f9;
        }

        .card-title {
            font-size: 18px !important;
            font-weight: 800 !important;
            color: #072d54 !important;
        }

        .card-body {
            padding: 20px !important;
        }

        .btn-success {
            background-color: #10b981 !important;
            border-color: #10b981 !important;
            border-radius: 12px !important;
            padding: 10px 20px !important;
            font-weight: 700 !important;
        }

        .btn-primary {
            background-color: #003b70 !important;
            border-color: #003b70 !important;
            border-radius: 12px !important;
        }
        
        .btn-info {
            background-color: #0066cc !important;
            border-color: #0066cc !important;
            border-radius: 12px !important;
        }

        .table thead th {
            background-color: #f8fbff !important;
            color: #072d54 !important;
            font-weight: 700 !important;
            border-top: none !important;
            border-bottom: 2px solid #eef3f8 !important;
            padding: 15px !important;
        }

        .table td {
            padding: 15px !important;
            vertical-align: middle !important;
            border-top: 1px solid #eef3f8 !important;
        }

        .badge {
            padding: 8px 12px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
        }

        .form-control {
            border-radius: 12px !important;
            border: 1px solid #d8e0ea !important;
            padding: 10px 15px !important;
            background-color: #f8fafc !important;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 20px 10px;
            }
            .brand strong, .brand small, .menu-title, .menu a span {
                display: none;
            }
            .main-content {
                margin-left: 80px;
                width: calc(100% - 80px);
            }
            .menu a {
                justify-content: center;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="layout">

    
    <aside class="sidebar">

        
        <div class="brand">
            <div class="brand-logo">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; padding: 2px;">
            </div>
            <div>
                <small>ADMIN</small>
                <strong>MENTARI</strong>
            </div>
        </div>

        
        <div class="menu">
            <a href="/beranda" class="<?php echo e(request()->is('beranda') ? 'active' : ''); ?>">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">DATA MASTER</div>
            
            <a href="<?php echo e(route('pendaftaran.index')); ?>" class="<?php echo e(request()->is('pendaftaran*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-user-plus"></i>
                <span>Pendaftaran</span>
            </a>

            <a href="/siswa" class="<?php echo e(request()->is('siswa*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Data Siswa</span>
            </a>

            <a href="/guru" class="<?php echo e(request()->is('guru*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Data Guru</span>
            </a>

            <a href="/kelas" class="<?php echo e(request()->is('kelas*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-school"></i>
                <span>Data Kelas</span>
            </a>

            <a href="/mapel" class="<?php echo e(request()->is('mapel*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-book"></i>
                <span>Mata Pelajaran</span>
            </a>

            <div class="menu-title">TRANSAKSI</div>

            <a href="/jadwal" class="<?php echo e(request()->is('jadwal*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Jadwal</span>
            </a>

            <a href="/tagihan" class="<?php echo e(request()->is('tagihan*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Tagihan</span>
            </a>

            <a href="/pembayaran" class="<?php echo e(request()->is('pembayaran*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-money-check-dollar"></i>
                <span>Pembayaran</span>
            </a>

            <div class="menu-title">AKADEMIK</div>

            <a href="<?php echo e(route('admin.konsultasi')); ?>" class="<?php echo e(request()->is('admin/konsultasi*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-comments"></i>
                <span>Konsultasi</span>
            </a>

            <a href="<?php echo e(route('admin.nilai')); ?>" class="<?php echo e(request()->is('admin/nilai*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-star"></i>
                <span>Rekap Nilai</span>
            </a>

            <a href="/admin/arsip-absensi" class="<?php echo e(request()->is('admin/arsip-absensi*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-box-archive"></i>
                <span>Arsip Absensi</span>
            </a>

            <div class="menu-title">LAINNYA</div>

            <a href="/materi" class="<?php echo e(request()->is('materi*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-book-open"></i>
                <span>Materi</span>
            </a>

            <a href="/notifikasi" class="<?php echo e(request()->is('notifikasi*') ? 'active' : ''); ?>">
                <i class="fa-solid fa-bell"></i>
                <span>Notifikasi</span>
            </a>

            <form action="/logout" method="POST" id="logout-form">
                <?php echo csrf_field(); ?>
                <button type="button" class="logout" onclick="confirmLogout(event)">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>

        </div>

    </aside>

    
    <main class="main-content">
        
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-weight-bold mb-0" style="color: #072d54;"><?php echo $__env->yieldContent('judul'); ?></h2>
                <p class="text-muted small mb-0">Kelola data bimbingan belajar Mentari</p>
            </div>
            
            <div class="d-flex align-items-center gap-3">

            </div>
        </div>

        
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:14px;">
          <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:14px;">
          <i class="fas fa-exclamation-circle mr-2"></i> <?php echo e(session('error')); ?>

          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:14px;">
          <strong><i class="fas fa-exclamation-triangle mr-2"></i>Periksa kembali data berikut:</strong>
          <ul class="mb-0 mt-2">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('konten'); ?>
        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // form-crud confirmation
    document.querySelectorAll('.form-crud').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const title = form.getAttribute('data-title') || 'Konfirmasi';
            const text  = form.getAttribute('data-text') || 'Apakah Anda yakin?';
            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#003b70',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });

    // form-delete confirmation
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
</script>

<?php echo $__env->yieldContent('scripts'); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/layouts/admin_modern.blade.php ENDPATH**/ ?>