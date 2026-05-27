

<?php $__env->startSection('content'); ?>
    <style>
        .jadwal-card {
            margin-bottom: 24px;
        }

        .jadwal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 16px;
        }

        .jadwal-info {
            flex: 1;
        }

        .jadwal-title {
            font-size: 18px;
            font-weight: 800;
            color: #072d54;
            margin: 0 0 4px 0;
        }

        .jadwal-subtitle {
            color: #6f7b8a;
            margin: 0;
            font-size: 14px;
        }

        .jadwal-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .stat-item {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-label {
            font-size: 12px;
            color: #7a8596;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 16px;
            font-weight: 800;
            color: #072d54;
        }

        .siswa-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
            font-size: 14px;
        }

        .siswa-table th,
        .siswa-table td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #e9eff4;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: none;
        }

        .siswa-table th {
            background: #f7fafc;
            color: #425069;
            font-weight: 700;
            font-size: 13px;
            white-space: nowrap;
        }

        .siswa-table td {
            vertical-align: middle;
        }

        .siswa-table .no-column {
            width: 50px;
            text-align: center;
        }

        .siswa-table .nama-column {
            min-width: 150px;
        }

        .siswa-table .wa-column {
            min-width: 120px;
        }

        .siswa-table .status-column {
            width: 100px;
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            background: #e9f7ef;
            color: #197f48;
        }

        @media (max-width: 768px) {
            .jadwal-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .jadwal-stats {
                grid-template-columns: 1fr;
            }

            .siswa-table {
                font-size: 13px;
            }

            .siswa-table th,
            .siswa-table td {
                padding: 8px 6px;
            }

            .siswa-table .nama-column,
            .siswa-table .wa-column {
                min-width: 120px;
            }
        }
    </style>

    <div class="topbar">
        <div>
            <h1>Jadwal Mengajar</h1>
            <p>Kelola dan pantau jadwal mengajar Anda</p>
        </div>

        <div class="badge"><?php echo e($guru->jadwal->count()); ?> Jadwal</div>
    </div>

    <?php if($guru && $guru->jadwal->count()): ?>
        <?php $__currentLoopData = $guru->jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card jadwal-card">
                <div class="jadwal-header">
                    <div class="jadwal-info">
                        <h3 class="jadwal-title"><?php echo e($j->mapel->nama_mapel ?? '-'); ?></h3>
                        <p class="jadwal-subtitle">Kelas <?php echo e($j->kelas->nama_kelas ?? '-'); ?></p>
                    </div>

                    <div class="badge"><?php echo e($j->siswa->count()); ?> Siswa</div>
                </div>

                <div class="jadwal-stats">
                    <div class="stat-item">
                        <div class="stat-label">Tanggal</div>
                        <div class="stat-value"><?php echo e(\Carbon\Carbon::parse($j->tanggal)->format('d/m/Y')); ?></div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-label">Waktu</div>
                        <div class="stat-value"><?php echo e($j->jam_mulai); ?> - <?php echo e($j->jam_selesai); ?></div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-label">Durasi</div>
                        <div class="stat-value"><?php echo e(\Carbon\Carbon::parse($j->jam_mulai)->diffInHours(\Carbon\Carbon::parse($j->jam_selesai))); ?> jam</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-label">Hari</div>
                        <div class="stat-value"><?php echo e(\Carbon\Carbon::parse($j->tanggal)->format('l')); ?></div>
                    </div>
                </div>

                <div style="font-size: 16px; font-weight: 700; color: #072d54; margin-bottom: 16px;">
                    <i class="fa-solid fa-users" style="margin-right: 8px;"></i>
                    Daftar Siswa Terdaftar
                </div>

                <?php if($j->siswa->count()): ?>
                    <div class="table-responsive">
                        <table class="siswa-table">
                            <thead>
                                <tr>
                                    <th class="no-column">No</th>
                                    <th class="nama-column">Nama Siswa</th>
                                    <th class="wa-column">No WhatsApp</th>
                                    <th class="status-column">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $j->siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="no-column"><?php echo e($index + 1); ?></td>
                                        <td class="nama-column"><?php echo e($siswa->nama_siswa); ?></td>
                                        <td class="wa-column"><?php echo e($siswa->no_whatsapp); ?></td>
                                        <td class="status-column">
                                            <span class="status-badge">Aktif</span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty">
                        <i class="fa-solid fa-user-slash" style="font-size: 32px; color: #ccc; margin-bottom: 12px;"></i>
                        <div>Belum ada siswa yang terdaftar dalam jadwal ini.</div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="card">
            <div class="empty">
                <i class="fa-solid fa-calendar-xmark" style="font-size: 48px; color: #ccc; margin-bottom: 16px;"></i>
                <div>Belum ada jadwal mengajar yang tersedia.</div>
                <div style="margin-top: 8px; color: #7b8490;">Jadwal akan muncul setelah admin menjadwalkan kelas Anda.</div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guru_user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/guru_user/jadwal.blade.php ENDPATH**/ ?>