<?php $__env->startSection('judul', 'Dashboard Admin'); ?>

<?php $__env->startSection('konten'); ?>

<style>
    .welcome-banner {
        background: linear-gradient(135deg, #003b70 0%, #064b86 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 10px 20px rgba(0, 59, 112, 0.1);
    }

    .stats-card {
        background: white;
        border-radius: 18px;
        padding: 20px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        display: flex;
        align-items: center;
        gap: 15px;
        height: 100%;
    }

    .stats-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .icon-siswa { background: #e0f2fe; color: #0ea5e9; }
    .icon-guru { background: #dcfce7; color: #22c55e; }
    .icon-jadwal { background: #fef3c7; color: #d97706; }
    .icon-pending { background: #fee2e2; color: #ef4444; }

    .stats-info h4 { font-size: 24px; font-weight: 800; margin: 0; color: #072d54; }
    .stats-info p { color: #64748b; margin: 0; font-size: 13px; font-weight: 500; }

    .content-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        height: 100%;
    }

    .card-header-modern {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .card-header-modern h5 { font-weight: 800; color: #072d54; margin: 0; font-size: 16px; }

    .chart-container {
        position: relative;
        height: 250px; /* FIXED HEIGHT */
        width: 100%;
    }

    .recent-list-item {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .recent-list-item:last-child { border-bottom: none; }

    .status-pill { padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; }
    .pill-pending { background: #fef3c7; color: #d97706; }
    .pill-lunas { background: #dcfce7; color: #16a34a; }

    .schedule-item {
        padding: 12px;
        background: #f8fafc;
        border-radius: 14px;
        margin-bottom: 10px;
        border-left: 4px solid #003b70;
    }

    .schedule-time { font-weight: 800; color: #003b70; font-size: 12px; }
    
    .btn-view-more {
        width: 100%;
        margin-top: 10px;
        padding: 8px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 13px;
        color: #003b70;
        background: #f1f5f9;
        border: none;
        text-align: center;
        display: block;
        transition: all 0.2s;
    }
    
    .btn-view-more:hover { background: #e2e8f0; text-decoration: none; }

</style>

<div class="container-fluid">

    
    <div class="welcome-banner">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h4 class="font-weight-bold mb-1">Halo Admin, Mentari Bimbingan Belajar 🌤️</h4>
                <p class="opacity-75 mb-0 small">Berikut adalah ringkasan aktivitas sistem hari ini.</p>
            </div>
            <div class="col-md-3 text-right d-none d-md-block">
                <small class="text-white-50"><?php echo e(now()->translatedFormat('d M Y')); ?></small>
            </div>
        </div>
    </div>

    
    <div class="row mb-3">
        <div class="col-lg-3 col-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon icon-siswa"><i class="fa-solid fa-user-graduate"></i></div>
                <div class="stats-info"><h4><?php echo e($jumlahSiswa); ?></h4><p>Siswa</p></div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon icon-guru"><i class="fa-solid fa-chalkboard-user"></i></div>
                <div class="stats-info"><h4><?php echo e($jumlahGuru); ?></h4><p>Guru</p></div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon icon-jadwal"><i class="fa-solid fa-calendar-day"></i></div>
                <div class="stats-info"><h4><?php echo e($jadwalHariIni->count()); ?></h4><p>Jadwal</p></div>
            </div>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <div class="stats-card">
                <div class="stats-icon icon-pending"><i class="fa-solid fa-money-bill-wave"></i></div>
                <div class="stats-info"><h4><?php echo e($pembayaranPending); ?></h4><p>Pending</p></div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-xl-7 mb-4">
            <div class="content-card">
                <div class="card-header-modern">
                    <h5>Statistik Siswa Per Kelas</h5>
                </div>
                <div class="chart-container">
                    <canvas id="chartSiswa"></canvas>
                </div>
            </div>
        </div>

        
        <div class="col-xl-5 mb-4">
            <div class="content-card">
                <div class="card-header-modern">
                    <h5>Tagihan Terbaru</h5>
                </div>
                <div class="recent-list">
                    <?php $__empty_1 = true; $__currentLoopData = $pembayaranTerbaru->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="recent-list-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="student-avatar" style="width: 35px; height: 35px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #64748b;">
                                    <?php echo e(substr($p->siswa->nama_siswa ?? '?', 0, 1)); ?>

                                </div>
                                <div>
                                    <span class="d-block font-weight-bold small" style="color: #072d54;"><?php echo e($p->siswa->nama_siswa ?? '-'); ?></span>
                                    <small class="text-muted" style="font-size: 11px;"><?php echo e($p->created_at->format('d M')); ?></small>
                                </div>
                            </div>
                            <span class="status-pill <?php echo e($p->status == 'lunas' ? 'pill-lunas' : 'pill-pending'); ?>">
                                <?php echo e($p->status); ?>

                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center text-muted py-4 small">Belum ada data.</p>
                    <?php endif; ?>
                </div>
                <a href="/pembayaran" class="btn-view-more">Lihat Semua Tagihan</a>
            </div>
        </div>

        
        <div class="col-xl-12 mb-4">
            <div class="content-card">
                <div class="card-header-modern">
                    <h5>Jadwal Hari Ini</h5>
                    <a href="/jadwal" class="small text-primary font-weight-bold">Buka Kalender →</a>
                </div>
                
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $jadwalHariIni->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4">
                            <div class="schedule-item">
                                <span class="schedule-time"><i class="far fa-clock"></i> <?php echo e($j->jam_mulai); ?> - <?php echo e($j->jam_selesai); ?></span>
                                <h6 class="font-weight-bold mb-1 small mt-1"><?php echo e($j->mapel->nama_mapel ?? '-'); ?></h6>
                                <p class="mb-0 text-muted" style="font-size: 11px;">
                                    <?php echo e($j->kelas->nama_kelas ?? '-'); ?> • <?php echo e($j->guru->nama_guru ?? '-'); ?>

                                </p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-center py-4">
                            <p class="text-muted small">Tidak ada jadwal hari ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if($jadwalHariIni->count() > 3): ?>
                    <a href="/jadwal" class="btn-view-more">Lihat <?php echo e($jadwalHariIni->count() - 3); ?> Jadwal Lainnya</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartSiswa');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php $__currentLoopData = $kelasChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    'Kls <?php echo e($k->nama_kelas); ?>',
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [
                    <?php $__currentLoopData = $kelasChart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($k->siswa_count); ?>,
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                ],
                backgroundColor: '#003b70',
                borderRadius: 8,
                barThickness: 25,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { display: false }, ticks: { precision: 0 } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/beranda.blade.php ENDPATH**/ ?>