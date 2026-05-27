<?php $__env->startSection('content'); ?>
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
    .form-card {
        background: #fff;
        border-radius: 22px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(7, 55, 99, 0.05);
        border: 1px solid #f0f5fa;
        margin-bottom: 30px;
    }
    .input-group {
        margin-bottom: 20px;
    }
    .input-group label {
        display: block;
        font-weight: 800;
        color: #7b8490;
        font-size: 12px;
        text-transform: uppercase;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }
    .form-control {
        width: 100%;
        padding: 14px;
        border-radius: 14px;
        border: 1px solid #d8e0ea;
        background: #f8fafc;
        color: #072d54;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        transition: 0.3s;
    }
    .form-control:focus {
        outline: none;
        border-color: #ffc107;
        background: #fff;
    }
    .btn-primary {
        background: #ffc107;
        color: #073763;
        border: none;
        padding: 14px 30px;
        border-radius: 14px;
        font-weight: 800;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-primary:hover {
        background: #ffca2c;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }
    
    .chat-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        margin-bottom: 20px;
        overflow: hidden;
        transition: 0.2s;
    }
    .chat-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
    }
    .chat-header {
        padding: 20px 25px;
        background: #fafbfc;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #edf2f7;
    }
    .chat-body {
        padding: 25px;
    }
    .bubble {
        padding: 16px 20px;
        border-radius: 16px;
        margin-bottom: 15px;
        max-width: 85%;
        position: relative;
    }
    .bubble-parent {
        background: #e3effd;
        color: #073763;
        border-top-left-radius: 0;
        margin-right: auto;
    }
    .bubble-guru {
        background: #f0fdf4;
        color: #166534;
        border-top-right-radius: 0;
        margin-left: auto;
        border: 1px solid #dcfce7;
    }
    .meta {
        font-size: 11px;
        color: #7b8490;
        margin-bottom: 4px;
        display: block;
    }
    .badge-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
    }
</style>

<div class="page-header">
    <div>
        <h1 style="margin: 0; font-size: 28px; font-weight: 800;">💬 Konsultasi Akademik</h1>
        <p style="margin: 5px 0 0; opacity: 0.8; font-size: 14px;">Media komunikasi terpadu antara Orang Tua & Guru Pengajar.</p>
    </div>
    <div style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 14px; font-weight: 700; backdrop-filter: blur(5px); font-size: 14px;">
        <i class="fa-solid fa-shield-heart mr-1"></i> Parent Mode
    </div>
</div>

<?php if(session('success')): ?>
    <div style="background: #e9f7ef; color: #197f48; border: 1px solid #d1f2e0; padding: 15px 25px; border-radius: 18px; margin-bottom: 25px; font-weight: 700;">
        <i class="fa-solid fa-circle-check mr-2"></i> <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
    
    
    <div>
        <div class="form-card">
            <h2 style="font-size: 18px; font-weight: 800; margin-top: 0; margin-bottom: 20px; color: #072d54;">
                <i class="fa-solid fa-paper-plane" style="color: #ffc107; margin-right: 8px;"></i> Ajukan Pertanyaan
            </h2>
            
            <form action="/siswa/parent/konsultasi" method="POST">
                <?php echo csrf_field(); ?>
                
                <div class="input-group">
                    <label>Pilih Guru Pengajar</label>
                    <select name="id_guru" class="form-control" required>
                        <option value="">-- Pilih Guru Pengajar --</option>
                        <?php $__currentLoopData = $daftarGuru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guru): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($guru->id); ?>"><?php echo e($guru->nama_guru); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="input-group">
                    <label>Perihal / Topik</label>
                    <input type="text" name="topik" class="form-control" placeholder="Contoh: Kesiapan Ujian Nasional" required>
                </div>

                <div class="input-group">
                    <label>Pertanyaan Detail</label>
                    <textarea name="pertanyaan" class="form-control" rows="5" placeholder="Tuliskan keluhan atau hal yang ingin ditanyakan tentang progres akademik anak..." required></textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                    Kirim Pertanyaan <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    
    <div>
        <h2 style="font-size: 20px; font-weight: 800; margin-top: 0; margin-bottom: 20px;">
            📋 Riwayat Komunikasi
        </h2>

        <?php $__empty_1 = true; $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="chat-card">
                <div class="chat-header">
                    <div>
                        <strong style="color: #072d54; display: block;"><?php echo e($item->topik); ?></strong>
                        <span style="font-size: 12px; color: #7b8490;">
                            Kepada: <strong><?php echo e($item->guru->nama_guru ?? 'Guru'); ?></strong>
                        </span>
                    </div>
                    <div>
                        <?php if($item->status == 'Menunggu'): ?>
                            <span class="badge-status" style="background: #fff8e1; color: #b45309;">Menunggu Balasan</span>
                        <?php else: ?>
                            <span class="badge-status" style="background: #e9f7ef; color: #15803d;">Sudah Dijawab</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="chat-body">
                    
                    <div style="text-align: left;">
                        <span class="meta">
                            <i class="fa-solid fa-user"></i> Anda • <?php echo e($item->created_at->translatedFormat('d M Y, H:i')); ?>

                        </span>
                        <div class="bubble bubble-parent">
                            <?php echo e($item->pertanyaan); ?>

                        </div>
                    </div>

                    
                    <?php if($item->jawaban): ?>
                        <div style="text-align: right; margin-top: 20px;">
                            <span class="meta">
                                <i class="fa-solid fa-chalkboard-user"></i> Balasan <?php echo e($item->guru->nama_guru ?? 'Guru'); ?> • <?php echo e($item->updated_at->translatedFormat('d M Y, H:i')); ?>

                            </span>
                            <div class="bubble bubble-guru">
                                <strong>Tanggapan Guru:</strong><br>
                                <?php echo e($item->jawaban); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div style="background: #f8fafc; border-radius: 12px; padding: 15px; text-align: center; border: 1px dashed #d8e0ea; margin-top: 20px;">
                            <span style="color: #9aa5b4; font-size: 13px; font-weight: 600;">
                                <i class="fa-solid fa-hourglass-half mr-1"></i> Menunggu feedback/saran dari Guru.
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="background: white; border-radius: 24px; padding: 60px 20px; text-align: center; border: 2px dashed #e3e9ef;">
                <i class="fa-solid fa-comments" style="font-size: 50px; color: #c8d6e5; margin-bottom: 15px; display: block;"></i>
                <h4 style="margin: 0; color: #7b8490; font-weight: 700;">Belum Ada Riwayat Konsultasi</h4>
                <p style="font-size: 13px; color: #9aa5b4; max-width: 300px; margin: 8px auto 0;">Gunakan form di sebelah kiri untuk mengirim pertanyaan akademis pertama Anda.</p>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('siswa_user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/siswa_user/konsultasi.blade.php ENDPATH**/ ?>