<?php $__env->startSection('content'); ?>

<style>
    .billing-header {
        background: linear-gradient(135deg, #003b70 0%, #064b86 100%);
        border-radius: 24px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 59, 112, 0.15);
    }
    .stat-pill {
        background: rgba(255, 255, 255, 0.1);
        padding: 12px 24px;
        border-radius: 100px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }
    .billing-card {
        background: white;
        border-radius: 28px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(7, 55, 99, 0.05);
        border: 1px solid #f0f5fa;
        margin-bottom: 25px;
    }
    .table-premium {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }
    .table-premium th {
        padding: 15px 20px;
        color: #7b8490;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 1.5px;
        text-align: left;
    }
    .table-premium td {
        padding: 20px;
        background: #f8fbff;
        border-top: 1px solid #edf2f7;
        border-bottom: 1px solid #edf2f7;
        text-align: left;
        vertical-align: middle;
    }
    .table-premium td:first-child { border-left: 1px solid #edf2f7; border-radius: 18px 0 0 18px; }
    .table-premium td:last-child { border-right: 1px solid #edf2f7; border-radius: 0 18px 18px 0; }
    
    .status-badge {
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 800;
    }
    .status-lunas { background: #e6fffa; color: #319795; }
    .status-belum { background: #fff5f5; color: #e53e3e; }
    .status-proses { background: #fffaf0; color: #dd6b20; }

    .upload-section {
        background: #f8fbff;
        border: 2px dashed #d0e1f0;
        border-radius: 24px;
        padding: 30px;
        transition: 0.3s;
    }
    .upload-section:hover {
        border-color: #003b70;
        background: #f0f7ff;
    }
    .btn-pay {
        background: #003b70;
        color: white;
        padding: 16px 30px;
        border-radius: 18px;
        font-weight: 800;
        border: none;
        transition: 0.3s;
        width: 100%;
        box-shadow: 0 10px 20px rgba(0, 59, 112, 0.15);
    }
    .btn-pay:hover {
        background: #064b86;
        transform: translateY(-2px);
    }
</style>

<div class="container">

    <div class="billing-header">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 20px;">
            <div>
                <h1 style="margin: 0; font-size: 32px; font-weight: 800;">Tagihan & Pembayaran</h1>
                <p style="margin: 8px 0 25px; opacity: 0.8; font-size: 16px;">Kelola biaya bimbingan belajarmu di sini.</p>
                <div class="stat-pill">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Total Tagihan: <strong>Rp <?php echo e(number_format($totalTagihan, 0, ',', '.')); ?></strong></span>
                </div>
            </div>
            <a href="/siswa-dashboard" style="background: rgba(255, 255, 255, 0.15); color: white; padding: 10px 20px; border-radius: 12px; font-weight: 700; text-decoration: none; backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1);">
                <i class="fa-solid fa-arrow-left"></i> Dashboard
            </a>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-8">
            <div class="billing-card">
                <h2 style="font-size: 22px; font-weight: 800; color: #072d54; margin-bottom: 25px;">Riwayat Pembayaran</h2>
                
                <div class="table-responsive">
                    <table class="table-premium">
                        <thead>
                            <tr>
                                <th>Periode</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td>
                                        <div style="font-weight: 800; color: #072d54;"><?php echo e(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->translatedFormat('F Y')); ?></div>
                                        <small style="color: #6f7b8a; font-weight: 600;">JT: <?php echo e(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->format('d/m/Y')); ?></small>
                                    </td>
                                    <td style="font-weight: 800; color: #003b70;">Rp <?php echo e(number_format($item->jumlah, 0, ',', '.')); ?></td>
                                    <td>
                                        <?php if($item->status == 'Lunas'): ?>
                                            <span class="status-badge status-lunas">Lunas</span>
                                        <?php elseif($item->status == 'Menunggu'): ?>
                                            <span class="status-badge status-proses">Proses Verifikasi</span>
                                        <?php else: ?>
                                            <span class="status-badge status-belum">Belum Bayar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small style="color: #6f7b8a; font-weight: 600;"><?php echo e(ucfirst($item->metode_pembayaran ?? 'Cash')); ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px; color: #6f7b8a;">Belum ada data tagihan.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">
            <div class="billing-card">
                <h3 style="font-size: 18px; font-weight: 800; color: #072d54; margin-bottom: 20px;">Konfirmasi Bayar</h3>
                
                <?php ($unpaid = $pembayaran->whereIn('status', ['Belum', 'Menunggu'])); ?>
                
                <?php if($unpaid->isEmpty()): ?>
                    <div style="text-align: center; padding: 20px;">
                        <i class="fa-solid fa-circle-check" style="font-size: 50px; color: #319795; margin-bottom: 15px;"></i>
                        <p style="font-weight: 700; color: #072d54; margin-bottom: 5px;">Tagihan Lunas!</p>
                        <p style="font-size: 13px; color: #6f7b8a;">Terima kasih telah melakukan pembayaran tepat waktu.</p>
                    </div>
                <?php else: ?>
                    <form action="<?php echo e(route('siswa.pembayaran.upload')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="font-size: 13px; font-weight: 700; color: #6f7b8a; margin-bottom: 8px; display: block;">Pilih Tagihan</label>
                            <select name="id_pembayaran" class="form-control" style="border-radius: 14px; height: auto; padding: 12px; border: 1px solid #d8e0ea; background: #f8fafc;" required>
                                <?php $__currentLoopData = $unpaid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal_jatuh_tempo)->translatedFormat('F Y')); ?> - Rp<?php echo e(number_format($item->jumlah, 0, ',', '.')); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="font-size: 13px; font-weight: 700; color: #6f7b8a; margin-bottom: 8px; display: block;">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control" style="border-radius: 14px; height: auto; padding: 12px; border: 1px solid #d8e0ea; background: #f8fafc;" required>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cash">Cash (Langsung)</option>
                            </select>
                        </div>

                        <div class="upload-section" style="margin-bottom: 25px; text-align: center; cursor: pointer;" onclick="document.getElementById('bukti_transfer').click()">
                            <input type="file" name="bukti_transfer" id="bukti_transfer" style="display: none;">
                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: #0066cc; margin-bottom: 10px;"></i>
                            <p style="margin: 0; font-size: 13px; font-weight: 700; color: #072d54;">Pilih Bukti Transfer</p>
                            <small style="font-size: 11px; color: #6f7b8a;">(JPG/PNG/PDF, Max 2MB)</small>
                        </div>

                        <button type="submit" class="btn-pay">Kirim Konfirmasi</button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="card" style="border-radius: 20px; background: #f8fbff; border: 1px solid #e3f2fd; padding: 20px;">
                <h4 style="font-size: 14px; font-weight: 800; color: #072d54; margin-bottom: 10px;">Info Rekening</h4>
                <div style="font-size: 13px; color: #003b70;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                        <span>Bank BRI</span>
                        <strong>4557 0100 8242 506</strong>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <span>A.N</span>
                        <strong>Suchi Aprilia</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('siswa_user.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/siswa_user/pembayaran.blade.php ENDPATH**/ ?>