

<?php $__env->startSection('content'); ?>
    <div class="topbar">
        <div>
            <h1>Selamat Datang, <?php echo e(explode(' ', $guru->nama_guru)[0]); ?>! 👋</h1>
            <p>Kelola kelas, jadwal, dan nilai siswa dengan mudah</p>
        </div>
        <div class="badge">
            <i class="fa-solid fa-circle" style="color: #10b981; font-size: 8px; margin-right: 6px;"></i>
            Aktif & Siap Mengajar
        </div>
    </div>

    <?php if($guru): ?>
        <!-- STATISTIK OVERVIEW -->
        <div class="grid">
            <div class="card stat">
                <div>
                    <h3>Jadwal Aktif</h3>
                    <strong style="color: #0066cc;"><?php echo e($totalJadwal); ?></strong>
                    <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Minggu Ini</p>
                </div>
                <div class="stat-icon" style="background: #e3f2fd; color: #0066cc;">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </div>

            <div class="card stat">
                <div>
                    <h3>Total Siswa</h3>
                    <strong style="color: #f59e0b;"><?php echo e($totalSiswa); ?></strong>
                    <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Mengikuti Kelas</p>
                </div>
                <div class="stat-icon" style="background: #fffbeb; color: #f59e0b;">
                    <i class="fa-solid fa-users-line"></i>
                </div>
            </div>

            <div class="card stat">
                <div>
                    <h3>Materi Dipublikasi</h3>
                    <strong style="color: #10b981;"><?php echo e($totalMateri); ?></strong>
                    <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Tersedia</p>
                </div>
                <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
                    <i class="fa-solid fa-book-open"></i>
                </div>
            </div>

            <div class="card stat">
                <div>
                    <h3>Penilaian Tercatat</h3>
                    <strong style="color: #ef4444;"><?php echo e($totalNilai); ?></strong>
                    <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Total Input</p>
                </div>
                <div class="stat-icon" style="background: #fee2e2; color: #ef4444;">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
        </div>

        <!-- JADWAL MINGGU DEPAN & AKSI CEPAT -->
        <div class="main-grid">
            <!-- JADWAL MENDATANG -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; border-bottom: 2px solid #f0f5fa; padding-bottom: 16px;">
                    <h2 class="section-title" style="margin: 0;">📅 Jadwal Mengajar Mendatang</h2>
                    <a href="/guru/jadwal" style="color: #0066cc; font-weight: 700; font-size: 13px; text-decoration: none;">Lihat Semua →</a>
                </div>

                <?php $__empty_1 = true; $__currentLoopData = $jadwal->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div style="padding: 16px; background: #f8fbff; border-radius: 16px; margin-bottom: 12px; border-left: 4px solid #0066cc;">
                        <div style="display: flex; justify-content: space-between; align-items: start; gap: 12px;">
                            <div>
                                <div style="font-weight: 700; color: #072d54; font-size: 15px; margin-bottom: 4px;">
                                    <?php echo e($j->mapel->nama_mapel ?? '-'); ?>

                                </div>
                                <div style="color: #6f7b8a; font-size: 13px; margin-bottom: 6px;">
                                    <i class="fa-solid fa-clock"></i> <?php echo e($j->jam_mulai); ?> - <?php echo e($j->jam_selesai); ?>

                                </div>
                                <div style="color: #6f7b8a; font-size: 13px;">
                                    <i class="fa-solid fa-door-open"></i> Kelas <?php echo e($j->kelas->nama_kelas ?? '-'); ?>

                                </div>
                            </div>
                            <div style="background: #e3f2fd; color: #0066cc; padding: 8px 12px; border-radius: 8px; font-size: 13px; font-weight: 700; white-space: nowrap;">
                                <?php echo e(\Carbon\Carbon::parse($j->tanggal)->format('d M')); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="empty">
                        <i class="fa-solid fa-calendar-xmark"></i> Tidak ada jadwal minggu ini
                    </div>
                <?php endif; ?>
            </div>

            <!-- PROFIL & AKSI CEPAT -->
            <div>
                <!-- KARTU PROFIL -->
                <div class="card" style="background: linear-gradient(135deg, #003b70 0%, #064b86 100%); color: white; margin-bottom: 20px;">
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <h3 style="margin: 0 0 4px; font-size: 20px; font-weight: 800;"><?php echo e($guru->nama_guru); ?></h3>
                        <p style="margin: 0 0 16px; color: rgba(255,255,255,0.8); font-size: 13px;">Instruktur Profesional</p>
                        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 16px;">
                            <p style="margin: 8px 0; font-size: 13px;">
                                <i class="fa-solid fa-phone"></i> <?php echo e($guru->no_whatsapp); ?>

                            </p>
                            <p style="margin: 8px 0; font-size: 13px;">
                                <i class="fa-solid fa-map-marker"></i> <?php echo e($guru->alamat ?? '-'); ?>

                            </p>
                        </div>
                    </div>
                </div>

                <!-- QUICK ACTIONS -->
                <div class="card">
                    <h3 style="margin: 0 0 16px; font-size: 15px; font-weight: 700; color: #072d54;">⚡ Aksi Cepat</h3>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <a href="/guru/nilai" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #f0f5fa; border-radius: 12px; text-decoration: none; color: #003b70; font-weight: 600; transition: all 0.25s ease;">
                            <i class="fa-solid fa-pencil" style="font-size: 16px;"></i>
                            <span>Input Nilai Siswa</span>
                            <i class="fa-solid fa-arrow-right" style="margin-left: auto; font-size: 12px;"></i>
                        </a>
                        <a href="/guru/materi" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #f0f5fa; border-radius: 12px; text-decoration: none; color: #003b70; font-weight: 600; transition: all 0.25s ease;">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 16px;"></i>
                            <span>Upload Materi</span>
                            <i class="fa-solid fa-arrow-right" style="margin-left: auto; font-size: 12px;"></i>
                        </a>
                        <a href="/guru/absensi" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #f0f5fa; border-radius: 12px; text-decoration: none; color: #003b70; font-weight: 600; transition: all 0.25s ease;">
                            <i class="fa-solid fa-clipboard-check" style="font-size: 16px;"></i>
                            <span>Input Absensi</span>
                            <i class="fa-solid fa-arrow-right" style="margin-left: auto; font-size: 12px;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MATERI TERBARU -->
        <div class="card" style="margin-top: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; border-bottom: 2px solid #f0f5fa; padding-bottom: 16px;">
                <h2 class="section-title" style="margin: 0;">📚 Materi Terbaru Dipublikasi</h2>
                <a href="/guru/materi" style="color: #0066cc; font-weight: 700; font-size: 13px; text-decoration: none;">Kelola Materi →</a>
            </div>
            
            <?php $__empty_1 = true; $__currentLoopData = $materi->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div style="padding: 14px 0; border-bottom: 1px solid #f0f5fa; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="font-weight: 700; color: #072d54; margin-bottom: 4px;"><?php echo e($m->judul_materi); ?></div>
                        <div style="color: #6f7b8a; font-size: 13px;"><?php echo e($m->kelas->nama_kelas ?? '-'); ?> • <?php echo e($m->mapel->nama_mapel ?? '-'); ?></div>
                    </div>
                    <div style="color: #6f7b8a; font-size: 13px; white-space: nowrap;">
                        <?php echo e($m->created_at->format('d M Y')); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty">Belum ada materi. <a href="/guru/materi" style="color: #0066cc; font-weight: 700;">Buat sekarang</a></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('guru_user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/guru_user/dashboard.blade.php ENDPATH**/ ?>