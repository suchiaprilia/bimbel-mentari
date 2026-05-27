<?php $__env->startSection('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="topbar">
    <div>
        <h1>Dashboard Orang Tua</h1>
        <p>Pantau perkembangan belajar dan administrasi <strong><?php echo e($siswa->nama_siswa); ?></strong> secara real-time.</p>
    </div>
    <div class="badge">
        <i class="fa-solid fa-shield-heart"></i>
        Parent Mode Active
    </div>
</div>

<div class="grid">
    <div class="card stat" style="border-left: 5px solid #ffc107;">
        <div>
            <h3>Rata-rata Nilai</h3>
            <strong><?php echo e(number_format($rataNilai, 1)); ?></strong>
        </div>
        <div class="stat-icon" style="background: #fff8e1; color: #ffc107;">
            <i class="fa-solid fa-star"></i>
        </div>
    </div>

    <div class="card stat" style="border-left: 5px solid #673ab7;">
        <div>
            <h3>Mapel Terbaik</h3>
            <strong style="font-size: 16px;"><?php echo e($mapelTerbaik); ?></strong>
        </div>
        <div class="stat-icon" style="background: #f3e5f5; color: #673ab7;">
            <i class="fa-solid fa-medal"></i>
        </div>
    </div>

    <div class="card stat" style="border-left: 5px solid #197f48;">
        <div>
            <h3>Total Lunas</h3>
            <strong>Rp <?php echo e(number_format($lunas, 0, ',', '.')); ?></strong>
        </div>
        <div class="stat-icon" style="background: #e9f7ef; color: #197f48;">
            <i class="fa-solid fa-check-double"></i>
        </div>
    </div>

    <div class="card stat" style="border-left: 5px solid #d32f2f;">
        <div>
            <h3>Sisa Tagihan</h3>
            <strong>Rp <?php echo e(number_format($tunggakan, 0, ',', '.')); ?></strong>
        </div>
        <div class="stat-icon" style="background: #fdecea; color: #d32f2f;">
            <i class="fa-solid fa-file-invoice-dollar"></i>
        </div>
    </div>
</div>


<div class="card" style="margin-bottom: 28px;">
    <h2 class="section-title">
        <i class="fa-solid fa-chart-line" style="color: #003b70; margin-right: 10px;"></i>
        Grafik Progres Nilai Siswa
    </h2>
    <div style="height: 300px;">
        <canvas id="nilaiChart"></canvas>
    </div>
</div>

<div class="main-grid">
    
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-graduation-cap" style="color: #ffc107; margin-right: 10px;"></i>
            Daftar Nilai Terakhir
        </h2>
        <?php if($nilaiTerakhir->count() > 0): ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                    <thead>
                        <tr style="text-align: left; border-bottom: 2px solid #eef3f8;">
                            <th style="padding: 12px 10px; color: #7b8490; font-size: 13px;">Mata Pelajaran</th>
                            <th style="padding: 12px 10px; color: #7b8490; font-size: 13px;">Nilai</th>
                            <th style="padding: 12px 10px; color: #7b8490; font-size: 13px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $nilaiTerakhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="border-bottom: 1px solid #eef3f8;">
                            <td style="padding: 15px 10px;">
                                <strong><?php echo e($n->mapel->nama_mapel); ?></strong>
                            </td>
                            <td style="padding: 15px 10px;">
                                <span class="badge" style="background: <?php echo e($n->nilai >= 75 ? '#e9f7ef' : '#fdecea'); ?>; color: <?php echo e($n->nilai >= 75 ? '#197f48' : '#d32f2f'); ?>; padding: 5px 12px;">
                                    <?php echo e($n->nilai); ?>

                                </span>
                            </td>
                            <td style="padding: 15px 10px; color: #7b8490; font-size: 14px;">
                                <?php echo e(date('d M Y', strtotime($n->created_at))); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 20px; text-align: center;">
                <a href="/siswa/nilai" class="btn" style="background: #f0f5fa; color: #003b70; font-size: 13px;">Lihat Semua Nilai</a>
            </div>
        <?php else: ?>
            <div class="empty">Belum ada data nilai yang tersedia.</div>
        <?php endif; ?>
    </div>

    
    <div class="card">
        <h2 class="section-title">
            <i class="fa-solid fa-receipt" style="color: #197f48; margin-right: 10px;"></i>
            Status Pembayaran
        </h2>
        <?php if($pembayaranTerakhir->count() > 0): ?>
            <?php $__currentLoopData = $pembayaranTerakhir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px 0; border-bottom: 1px solid #eef3f8;">
                <div>
                    <div style="font-weight: 700; color: #072d54;"><?php echo e($p->bulan); ?></div>
                    <div style="font-size: 12px; color: #7b8490;">Jatuh Tempo: <?php echo e(date('d M Y', strtotime($p->tanggal_jatuh_tempo))); ?></div>
                </div>
                <div style="text-align: right;">
                    <div style="font-weight: 800; color: #072d54; margin-bottom: 5px;">Rp <?php echo e(number_format($p->jumlah, 0, ',', '.')); ?></div>
                    <span style="font-size: 11px; padding: 4px 10px; border-radius: 99px; font-weight: 800; 
                        <?php if($p->status == 'Lunas'): ?> background: #e9f7ef; color: #197f48; 
                        <?php elseif($p->status == 'Menunggu'): ?> background: #fff8e1; color: #ffc107;
                        <?php else: ?> background: #fdecea; color: #d32f2f; <?php endif; ?>">
                        <?php echo e(strtoupper($p->status)); ?>

                    </span>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div style="margin-top: 20px; text-align: center;">
                <a href="/siswa/pembayaran" class="btn" style="background: #f0f5fa; color: #003b70; font-size: 13px;">Rincian Pembayaran</a>
            </div>
        <?php else: ?>
            <div class="empty">Belum ada data tagihan.</div>
        <?php endif; ?>
    </div>
</div>

<script>
    const ctx = document.getElementById('nilaiChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [{
                label: 'Nilai Siswa',
                data: <?php echo json_encode($chartData); ?>,
                borderColor: '#003b70',
                backgroundColor: 'rgba(0, 59, 112, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#ffc107',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        drawBorder: false,
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('siswa_user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/siswa_user/parent_dashboard.blade.php ENDPATH**/ ?>