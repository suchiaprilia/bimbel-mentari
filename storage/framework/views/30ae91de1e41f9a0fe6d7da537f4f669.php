<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Status Pendaftaran | Bimbel Mentari</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --navy: #003366;
      --navy-light: #004080;
      --yellow: #FFB800;
      --yellow-light: #FFC933;
      --white: #ffffff;
      --light: #f8f9fa;
      --gray: #6c757d;
      --dark: #1a1a2e;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f8f9fa 0%, #eef3f8 100%);
      color: var(--dark);
      min-height: 100vh;
    }

    .main-box {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 35px 15px;
      position: relative;
      overflow: hidden;
    }

    .main-box::before {
      content: '';
      position: absolute;
      width: 420px;
      height: 420px;
      background: rgba(255, 184, 0, 0.15);
      border-radius: 50%;
      top: -160px;
      right: -120px;
    }

    .main-box::after {
      content: '';
      position: absolute;
      width: 420px;
      height: 420px;
      background: rgba(0, 51, 102, 0.08);
      border-radius: 50%;
      bottom: -160px;
      left: -120px;
    }

    .status-card {
      background: var(--white);
      border-radius: 28px;
      box-shadow: 0 20px 55px rgba(0, 51, 102, 0.16);
      overflow: hidden;
      position: relative;
      z-index: 1;
      border: none;
    }

    .left-side {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
      padding: 45px;
      height: 100%;
      position: relative;
      overflow: hidden;
    }

    .left-side::before {
      content: '';
      position: absolute;
      width: 260px;
      height: 260px;
      background: rgba(255, 255, 255, 0.08);
      border-radius: 50%;
      top: -90px;
      right: -90px;
    }

    .left-side::after {
      content: '';
      position: absolute;
      width: 180px;
      height: 180px;
      background: rgba(255, 184, 0, 0.18);
      border-radius: 50%;
      bottom: -70px;
      left: -70px;
    }

    .left-content {
      position: relative;
      z-index: 1;
    }

    .brand-box {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 28px;
    }

    .brand-icon {
      width: 58px;
      height: 58px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--navy);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      box-shadow: 0 8px 24px rgba(255, 184, 0, 0.35);
    }

    .brand-text small {
      display: block;
      font-size: 11px;
      letter-spacing: 4px;
      font-weight: 700;
      color: rgba(255,255,255,0.85);
      line-height: 1;
    }

    .brand-text strong {
      font-size: 28px;
      font-weight: 800;
      color: var(--white);
      letter-spacing: 1px;
      line-height: 1.2;
    }

    .brand-text strong span {
      color: var(--yellow);
    }

    .left-side h2 {
      font-size: 30px;
      font-weight: 800;
      margin-bottom: 15px;
    }

    .left-side p {
      color: rgba(255,255,255,0.84);
      line-height: 1.8;
      margin-bottom: 0;
    }

    .info-list {
      margin-top: 30px;
    }

    .info-item {
      display: flex;
      gap: 14px;
      margin-bottom: 18px;
    }

    .info-icon {
      width: 40px;
      height: 40px;
      background: var(--yellow);
      color: var(--navy);
      border-radius: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .info-item h6 {
      font-weight: 800;
      margin-bottom: 3px;
      color: var(--white);
    }

    .info-item p {
      font-size: 13px;
      color: rgba(255,255,255,0.75);
      line-height: 1.6;
    }

    .right-side {
      padding: 45px;
    }

    .form-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 184, 0, 0.16);
      color: var(--navy);
      padding: 8px 16px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 800;
      margin-bottom: 14px;
    }

    .form-badge i {
      color: var(--yellow);
    }

    .right-side h4 {
      font-size: 30px;
      color: var(--navy);
      font-weight: 800;
      margin-bottom: 8px;
    }

    .subtitle {
      color: var(--gray);
      font-size: 14px;
      line-height: 1.7;
      margin-bottom: 25px;
    }

    label {
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 8px;
      font-size: 14px;
    }

    .form-control {
      border-radius: 14px;
      padding: 13px 14px;
      border: 1px solid #dfe5ec;
      font-size: 14px;
    }

    .form-control:focus {
      border-color: var(--yellow);
      box-shadow: 0 0 0 4px rgba(255, 184, 0, 0.16);
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--yellow), var(--yellow-light));
      color: var(--navy);
      border: none;
      border-radius: 50px;
      padding: 14px 24px;
      font-weight: 800;
      box-shadow: 0 10px 25px rgba(255, 184, 0, 0.35);
      transition: all 0.3s;
    }

    .btn-submit:hover {
      background: var(--navy);
      color: var(--white);
      transform: translateY(-3px);
    }

    .back-link {
      color: var(--gray);
      text-decoration: none;
      font-weight: 600;
    }

    .back-link:hover {
      color: var(--yellow);
    }

    .result-box {
      margin-top: 28px;
      border-radius: 22px;
      padding: 24px;
      border: 1px solid rgba(0,51,102,0.08);
      background: #f8f9fa;
    }

    .status-label {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 800;
      margin-bottom: 18px;
    }

    .status-menunggu {
      background: rgba(255, 184, 0, 0.18);
      color: #8a6100;
    }

    .status-diterima {
      background: rgba(40, 167, 69, 0.16);
      color: #1e7e34;
    }

    .status-ditolak {
      background: rgba(220, 53, 69, 0.14);
      color: #b02a37;
    }

    .result-title {
      color: var(--navy);
      font-size: 22px;
      font-weight: 800;
      margin-bottom: 14px;
    }

    .result-item {
      display: flex;
      justify-content: space-between;
      gap: 15px;
      padding: 10px 0;
      border-bottom: 1px solid rgba(0,51,102,0.08);
      font-size: 14px;
    }

    .result-item:last-child {
      border-bottom: none;
    }

    .result-item span:first-child {
      color: var(--gray);
    }

    .result-item span:last-child {
      color: var(--navy);
      font-weight: 700;
      text-align: right;
    }

    .keterangan-box {
      margin-top: 18px;
      background: rgba(0,51,102,0.06);
      border-left: 4px solid var(--yellow);
      border-radius: 14px;
      padding: 14px 16px;
      color: var(--navy);
      font-size: 14px;
      line-height: 1.7;
    }

    .alert {
      border-radius: 14px;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .left-side,
      .right-side {
        padding: 32px 24px;
      }

      .right-side h4 {
        font-size: 25px;
      }

      .result-item {
        flex-direction: column;
        gap: 3px;
      }

      .result-item span:last-child {
        text-align: left;
      }
    }
  </style>
</head>

<body>

<div class="container main-box">
  <div class="row w-100">
    <div class="col-lg-10 mx-auto">
      <div class="card status-card">
        <div class="row g-0">

          <div class="col-md-5 left-side">
            <div class="left-content">

              <div class="brand-box">
                <div class="brand-icon">
                  <i class="fas fa-sun"></i>
                </div>
                <div class="brand-text">
                  <small>BIMBEL</small>
                  <strong>MEN<span>T</span>ARI</strong>
                </div>
              </div>

              <h2>Cek Status Pendaftaran</h2>
              <p>
                Gunakan kode pendaftaran atau nomor WhatsApp yang digunakan saat mendaftar
                untuk melihat apakah data pendaftaran masih menunggu, diterima, atau ditolak.
              </p>

              <div class="info-list">
                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-ticket-alt"></i>
                  </div>
                  <div>
                    <h6>Kode / Nomor WhatsApp</h6>
                    <p>Masukkan kode pendaftaran atau nomor WhatsApp yang digunakan saat mengisi formulir.</p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-clipboard-check"></i>
                  </div>
                  <div>
                    <h6>Status Verifikasi</h6>
                    <p>Status berubah setelah admin memeriksa data pendaftaran.</p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div>
                    <h6>Pengingat Pembayaran</h6>
                    <p>WhatsApp digunakan untuk notifikasi pembayaran setelah siswa terdaftar.</p>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-md-7 right-side">

            <div class="form-badge">
              <i class="fas fa-search"></i>
              Cek Status
            </div>

            <h4>Status Pendaftaran</h4>
            <p class="subtitle">
              Masukkan kode pendaftaran atau nomor WhatsApp yang digunakan saat mendaftar untuk melihat hasil verifikasi.
            </p>

            <?php if(session('error')): ?>
              <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

              </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
              <div class="alert alert-danger">
                <ul class="mb-0">
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
            <?php endif; ?>

            <form action="<?php echo e(route('cek-status.proses')); ?>" method="POST">
              <?php echo csrf_field(); ?>

              <div class="mb-3">
                <label>Kode Pendaftaran / Nomor WhatsApp</label>
                <input type="text" name="keyword" class="form-control"
                  value="<?php echo e(old('keyword')); ?>"
                  placeholder="Contoh: BM-20260503-0001 atau 081234567890" required>
              </div>

              <div class="d-grid mt-4">
                <button class="btn btn-submit">
                  <i class="fas fa-search me-2"></i>Cek Status
                </button>
              </div>
            </form>

            <?php if(isset($pendaftaran)): ?>
              <?php
                $status = strtolower($pendaftaran->status);

                if ($status == 'diterima') {
                  $statusClass = 'status-diterima';
                  $statusIcon = 'fas fa-check-circle';
                  $statusText = 'Diterima';
                  $pesanDefault = 'Selamat, pendaftaran Anda telah diterima. Silakan menunggu informasi jadwal belajar dari admin.';
                } elseif ($status == 'ditolak') {
                  $statusClass = 'status-ditolak';
                  $statusIcon = 'fas fa-times-circle';
                  $statusText = 'Ditolak';
                  $pesanDefault = 'Mohon maaf, pendaftaran Anda belum dapat diterima.';
                } else {
                  $statusClass = 'status-menunggu';
                  $statusIcon = 'fas fa-clock';
                  $statusText = 'Menunggu Verifikasi';
                  $pesanDefault = 'Data pendaftaran Anda masih dalam proses pengecekan oleh admin.';
                }
              ?>

              <div class="result-box">
                <div class="status-label <?php echo e($statusClass); ?>">
                  <i class="<?php echo e($statusIcon); ?>"></i>
                  <?php echo e($statusText); ?>

                </div>

                <h5 class="result-title"><?php echo e($pendaftaran->nama_siswa); ?></h5>

                <div class="result-item">
                  <span>Kode Pendaftaran</span>
                  <span><?php echo e($pendaftaran->kode_pendaftaran); ?></span>
                </div>

                <div class="result-item">
                  <span>Nomor WhatsApp</span>
                  <span><?php echo e($pendaftaran->no_whatsapp); ?></span>
                </div>

                <div class="result-item">
                  <span>Jenjang</span>
                  <span><?php echo e($pendaftaran->jenjang ?? '-'); ?></span>
                </div>

                <div class="result-item">
                  <span>Kelas Dipilih</span>
                  <span><?php echo e($pendaftaran->kelas_dipilih ?? '-'); ?></span>
                </div>

                <div class="result-item">
                  <span>Tanggal Daftar</span>
                  <span><?php echo e($pendaftaran->tanggal_daftar ?? '-'); ?></span>
                </div>

                <div class="keterangan-box">
                  <strong>Keterangan:</strong><br>
                  <?php echo e($pendaftaran->keterangan ?? $pesanDefault); ?>

                </div>
              </div>
            <?php endif; ?>

            <div class="text-center mt-4">
              <a href="/" class="back-link">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
              </a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/cek-status.blade.php ENDPATH**/ ?>