<?php $__env->startSection('content'); ?>

<div class="topbar">
    <div>
        <h1>Hai, <?php echo e(explode(' ', $siswa->nama_siswa)[0]); ?>! 👋</h1>
        <p>Pantau jadwal, materi, dan nilai belajarmu di sini</p>
    </div>
    <div class="badge">
        <i class="fa-solid fa-circle" style="color: #10b981; font-size: 8px; margin-right: 6px;"></i>
        <?php echo e($siswa->status); ?>

    </div>
</div>

<?php if($siswa): ?>

    <!-- STATISTIK OVERVIEW -->
    <div class="grid">
        <div class="card stat">
            <div>
                <h3>Jadwal Belajar</h3>
                <strong style="color: #0066cc;"><?php echo e($jadwal->count()); ?></strong>
                <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Minggu Ini</p>
            </div>
            <div class="stat-icon" style="background: #e3f2fd; color: #0066cc;">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        </div>

        <div class="card stat">
            <div>
                <h3>Materi Tersedia</h3>
                <strong style="color: #10b981;"><?php echo e($materi->count()); ?></strong>
                <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Untuk Dipelajari</p>
            </div>
            <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
                <i class="fa-solid fa-book-open"></i>
            </div>
        </div>

        <div class="card stat">
            <div>
                <h3>Nilai Tercatat</h3>
                <strong style="color: #f59e0b;"><?php echo e($nilaiCount ?? 0); ?></strong>
                <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Dari Guru</p>
            </div>
            <div class="stat-icon" style="background: #fffbeb; color: #f59e0b;">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
        </div>

        <div class="card stat">
            <div>
                <h3>Kelas</h3>
                <strong style="color: #8b5cf6;"><?php echo e($siswa->kelas->nama_kelas ?? '-'); ?></strong>
                <p style="margin: 6px 0 0; color: #6f7b8a; font-size: 13px;">Aktif</p>
            </div>
            <div class="stat-icon" style="background: #f3e8ff; color: #8b5cf6;">
                <i class="fa-solid fa-building-columns"></i>
            </div>
        </div>
    </div>

    <!-- JADWAL HARI INI & PROFIL -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 28px; margin-top: 20px;">
        <!-- JADWAL HARI INI & MENDATANG -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; border-bottom: 2px solid #f0f5fa; padding-bottom: 16px;">
                <h2 class="section-title" style="margin: 0;">📅 Jadwal Belajarmu</h2>
                <a href="/siswa/jadwal" style="color: #0066cc; font-weight: 700; font-size: 13px; text-decoration: none;">Lihat Semua →</a>
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
                                <i class="fa-solid fa-chalkboard-user"></i> Guru: <?php echo e($j->guru->nama_guru ?? '-'); ?>

                            </div>
                        </div>
                        <div style="background: #e3f2fd; color: #0066cc; padding: 8px 12px; border-radius: 8px; font-size: 13px; font-weight: 700; white-space: nowrap;">
                            <?php echo e(\Carbon\Carbon::parse($j->tanggal)->format('d M')); ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty">
                    <i class="fa-solid fa-calendar-xmark"></i> Belum ada jadwal minggu ini
                </div>
            <?php endif; ?>
        </div>

        <!-- KARTU PROFIL & AKSI CEPAT -->
        <div>
            <!-- PROFIL SISWA -->
            <div class="card" style="background: linear-gradient(135deg, #003b70 0%, #064b86 100%); color: white; margin-bottom: 20px;">
                <div style="text-align: center;">
                    <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <h3 style="margin: 0 0 4px; font-size: 20px; font-weight: 800;"><?php echo e($siswa->nama_siswa); ?></h3>
                    <p style="margin: 0 0 16px; color: rgba(255,255,255,0.8); font-size: 13px;">Siswa Aktif</p>
                    <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 16px;">
                        <p style="margin: 8px 0; font-size: 13px;">
                            <i class="fa-solid fa-building-columns"></i> <?php echo e($siswa->kelas->nama_kelas ?? '-'); ?>

                        </p>
                        <p style="margin: 8px 0; font-size: 13px;">
                            <i class="fa-solid fa-phone"></i> <?php echo e($siswa->no_whatsapp); ?>

                        </p>
                    </div>
                </div>
            </div>

            <!-- AKSI CEPAT -->
            <div class="card">
                <h3 style="margin: 0 0 16px; font-size: 15px; font-weight: 700; color: #072d54;">⚡ Aksi Cepat</h3>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="/siswa/nilai" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #f0f5fa; border-radius: 12px; text-decoration: none; color: #003b70; font-weight: 600; transition: all 0.25s ease;">
                        <i class="fa-solid fa-chart-simple" style="font-size: 16px;"></i>
                        <span>Lihat Nilaimu</span>
                        <i class="fa-solid fa-arrow-right" style="margin-left: auto; font-size: 12px;"></i>
                    </a>
                    <a href="/siswa/materi" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #f0f5fa; border-radius: 12px; text-decoration: none; color: #003b70; font-weight: 600; transition: all 0.25s ease;">
                        <i class="fa-solid fa-book" style="font-size: 16px;"></i>
                        <span>Pelajari Materi</span>
                        <i class="fa-solid fa-arrow-right" style="margin-left: auto; font-size: 12px;"></i>
                    </a>
                    <a href="/siswa/profil" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #f0f5fa; border-radius: 12px; text-decoration: none; color: #003b70; font-weight: 600; transition: all 0.25s ease;">
                        <i class="fa-solid fa-user" style="font-size: 16px;"></i>
                        <span>Edit Profil</span>
                        <i class="fa-solid fa-arrow-right" style="margin-left: auto; font-size: 12px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- MATERI TERBARU -->
    <div class="card" style="margin-top: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px; border-bottom: 2px solid #f0f5fa; padding-bottom: 16px;">
            <h2 class="section-title" style="margin: 0;">📚 Materi Terbaru</h2>
            <a href="/siswa/materi" style="color: #0066cc; font-weight: 700; font-size: 13px; text-decoration: none;">Lihat Semua →</a>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $materi->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="padding: 14px 16px; background: #f8fbff; border-radius: 12px; margin-bottom: 12px; border-left: 3px solid #0066cc;">
                <div style="display: flex; justify-content: space-between; align-items: start; gap: 12px;">
                    <div style="flex: 1;">
                        <div style="font-weight: 700; color: #072d54; margin-bottom: 6px;"><?php echo e($m->judul_materi); ?></div>
                        <div style="color: #6f7b8a; font-size: 13px;">
                            <i class="fa-solid fa-book-open"></i> <?php echo e($m->mapel->nama_mapel ?? '-'); ?> • 
                            <i class="fa-solid fa-chalkboard-user"></i> <?php echo e($m->guru->nama_guru ?? '-'); ?>

                        </div>
                    </div>
                    <?php if($m->file_materi): ?>
                        <a href="<?php echo e(asset('storage/' . $m->file_materi)); ?>" target="_blank" style="background: #ffc107; color: #073763; padding: 8px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; text-decoration: none; white-space: nowrap;">
                            <i class="fa-solid fa-download"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty">
                <i class="fa-solid fa-book-xmark"></i> Belum ada materi. Pantau terus!
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('siswa_user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/siswa_user/dashboard.blade.php ENDPATH**/ ?>