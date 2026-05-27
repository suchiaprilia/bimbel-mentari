<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Bimbel Mentari</title>

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

    .card-custom {
      border: none;
      border-radius: 28px;
      overflow: hidden;
      box-shadow: 0 20px 55px rgba(0, 51, 102, 0.16);
      position: relative;
      z-index: 1;
      background: var(--white);
    }

    .left-side {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: white;
      padding: 45px;
      min-height: 100%;
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

    .left-side .desc {
      color: rgba(255,255,255,0.86);
      line-height: 1.8;
      margin-bottom: 28px;
    }

    .benefit-list {
      margin-top: 30px;
    }

    .benefit-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 18px;
    }

    .benefit-icon {
      width: 40px;
      height: 40px;
      background: var(--yellow);
      color: var(--navy);
      border-radius: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 15px;
    }

    .benefit-item h6 {
      font-weight: 800;
      margin-bottom: 3px;
      color: var(--white);
    }

    .benefit-item p {
      margin: 0;
      font-size: 13px;
      color: rgba(255,255,255,0.75);
      line-height: 1.6;
    }

    .step-box {
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.12);
      border-radius: 18px;
      padding: 18px;
      margin-top: 30px;
      backdrop-filter: blur(8px);
    }

    .step-box h6 {
      font-weight: 800;
      margin-bottom: 10px;
      color: var(--yellow);
    }

    .step-box p {
      margin: 0;
      color: rgba(255,255,255,0.78);
      font-size: 13px;
      line-height: 1.7;
    }

    .form-side {
      padding: 42px;
    }

    .form-header {
      margin-bottom: 28px;
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

    .form-header h4 {
      font-size: 30px;
      color: var(--navy);
      font-weight: 800;
      margin-bottom: 8px;
    }

    .form-header p {
      color: var(--gray);
      margin: 0;
      font-size: 14px;
      line-height: 1.7;
    }

    label {
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 7px;
      font-size: 14px;
    }

    .form-control,
    .form-select {
      border-radius: 14px;
      padding: 12px 14px;
      border: 1px solid #dfe5ec;
      color: var(--dark);
      font-size: 14px;
      transition: all 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--yellow);
      box-shadow: 0 0 0 4px rgba(255, 184, 0, 0.16);
    }

    textarea.form-control {
      resize: vertical;
    }

    .small-note {
      font-size: 12px;
      color: var(--gray);
      margin-top: 6px;
    }

    .selected-program-info {
      background: rgba(0, 51, 102, 0.06);
      border-left: 4px solid var(--yellow);
      border-radius: 14px;
      padding: 13px 15px;
      margin-bottom: 20px;
      color: var(--navy);
      font-size: 14px;
      line-height: 1.6;
    }

    .selected-program-info strong {
      color: var(--navy);
      font-weight: 800;
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--yellow), var(--yellow-light));
      color: var(--navy);
      border: none;
      border-radius: 50px;
      padding: 14px 24px;
      font-weight: 800;
      font-size: 16px;
      box-shadow: 0 10px 25px rgba(255, 184, 0, 0.35);
      transition: all 0.3s;
    }

    .btn-submit:hover {
      background: var(--navy);
      color: var(--white);
      transform: translateY(-3px);
      box-shadow: 0 14px 30px rgba(0, 51, 102, 0.25);
    }

    .back-link {
      color: var(--gray);
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
    }

    .back-link:hover {
      color: var(--yellow);
    }

    .alert {
      border-radius: 14px;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .main-box {
        padding: 20px 12px;
      }

      .left-side {
        padding: 32px 26px;
      }

      .form-side {
        padding: 32px 24px;
      }

      .form-header h4 {
        font-size: 25px;
      }

      .brand-text strong {
        font-size: 24px;
      }
    }
  </style>
</head>

<body>

@php
  $programParam = request('program');

  $selectedJenjang = old('jenjang',
    $programParam === 'sd' ? 'SD' :
    ($programParam === 'smp' ? 'SMP' :
    ($programParam === 'sma' ? 'SMA' : ''))
  );

  $namaProgram = $selectedJenjang
    ? 'Program ' . $selectedJenjang
    : null;
@endphp

<div class="container main-box">
  <div class="row w-100">

    <div class="col-lg-10 mx-auto">
      <div class="card card-custom">

        <div class="row g-0">

          {{-- KIRI --}}
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

              <h2>Daftar Bimbingan Belajar</h2>

              <p class="desc">
                Daftarkan siswa sekarang dan ikuti kegiatan bimbingan belajar
                yang lebih terarah melalui program SD, SMP, dan SMA di Bimbel Mentari.
              </p>

              <div class="benefit-list">
                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fas fa-user-graduate"></i>
                  </div>
                  <div>
                    <h6>Belajar Terarah</h6>
                    <p>Materi disesuaikan dengan jenjang dan kebutuhan belajar siswa.</p>
                  </div>
                </div>

                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fas fa-calendar-check"></i>
                  </div>
                  <div>
                    <h6>Informasi Jadwal Belajar</h6>
                    <p>Data jadwal belajar dapat dicatat dan ditampilkan melalui sistem.</p>
                  </div>
                </div>

                <div class="benefit-item">
                  <div class="benefit-icon">
                    <i class="fab fa-whatsapp"></i>
                  </div>
                  <div>
                    <h6>Pengingat Pembayaran</h6>
                    <p>Nomor WhatsApp digunakan untuk menerima notifikasi atau pengingat pembayaran.</p>
                  </div>
                </div>
              </div>

              <div class="step-box">
                <h6><i class="fas fa-info-circle me-2"></i>Alur Singkat</h6>
                <p>
                  Isi formulir pendaftaran, pilih jenjang belajar, lalu admin akan
                  memeriksa dan memproses data pendaftaran yang telah dikirim.
                </p>
              </div>

            </div>
          </div>

          {{-- KANAN --}}
          <div class="col-md-7 form-side">

            <div class="form-header">
              <div class="form-badge">
                <i class="fas fa-file-signature"></i>
                Form Pendaftaran
              </div>

              <h4>Pendaftaran Siswa</h4>
              <p>
                Lengkapi data berikut dengan benar agar admin dapat memproses
                pendaftaran. Nomor WhatsApp digunakan untuk notifikasi atau pengingat pembayaran.
              </p>
            </div>

            @if(session('success'))
              <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
              </div>
            @endif

            @if($errors->any())
              <div class="alert alert-danger">
                <strong>Periksa kembali data berikut:</strong>
                <ul class="mb-0 mt-2">
                  @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            @if($namaProgram)
              <div class="selected-program-info">
                <i class="fas fa-check-circle me-2"></i>
                Anda sedang mendaftar untuk <strong>{{ $namaProgram }}</strong>.
                Jenjang sudah otomatis dipilih.
              </div>
            @endif

            <form action="{{ route('daftar.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label>Nama Siswa <span class="text-danger">*</span></label>
                <input type="text" name="nama_siswa" class="form-control"
                  value="{{ old('nama_siswa') }}" placeholder="Masukkan nama lengkap siswa" required>
              </div>

              <div class="mb-3">
                <label>Nama Orang Tua</label>
                <input type="text" name="nama_ortu" class="form-control"
                  value="{{ old('nama_ortu') }}" placeholder="Masukkan nama orang tua/wali">
              </div>

              <div class="mb-3">
                <label>No WhatsApp <span class="text-danger">*</span></label>
                <input type="text" name="no_whatsapp" class="form-control"
                  value="{{ old('no_whatsapp') }}" placeholder="Contoh: 081234567890" required>
                <div class="small-note">Nomor WhatsApp digunakan untuk menerima notifikasi atau pengingat pembayaran.</div>
              </div>

              <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"
                  placeholder="Masukkan alamat siswa">{{ old('alamat') }}</textarea>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label>Jenjang</label>
                  <select name="jenjang" class="form-select">
                    <option value="">-- Pilih Jenjang --</option>
                    <option value="SD" {{ $selectedJenjang == 'SD' ? 'selected' : '' }}>SD</option>
                    <option value="SMP" {{ $selectedJenjang == 'SMP' ? 'selected' : '' }}>SMP</option>
                    <option value="SMA" {{ $selectedJenjang == 'SMA' ? 'selected' : '' }}>SMA</option>
                  </select>
                </div>

               <div class="col-md-6 mb-3">
    <label class="form-label">
        Pilih Kelas <span class="text-danger">*</span>
    </label>

    <select name="id_kelas"
        class="form-select @error('id_kelas') is-invalid @enderror">

        <option value="">-- Pilih Kelas --</option>

        @foreach($kelas as $k)

            <option value="{{ $k->id }}"
                {{ old('id_kelas') == $k->id ? 'selected' : '' }}>

                {{ $k->nama_kelas }}

            </option>

        @endforeach

    </select>

    @error('id_kelas')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
              {{-- BAGIAN BARU: PILIH MATA PELAJARAN --}}
              <div class="mb-4" id="mapel-section">
                <label class="form-label">Pilih Mata Pelajaran (Bisa lebih dari 1) <span class="text-danger">*</span></label>
                <div class="mapel-container p-3 border rounded-3 bg-light">
                  <div class="row" id="mapel-list">
                    @foreach($mapels as $m)
                    <div class="col-md-6 mb-2 mapel-item">
                      <div class="form-check custom-checkbox">
                        <input class="form-check-input" type="checkbox" name="mapel_id[]" value="{{ $m->id_mapel }}" id="mapel{{ $m->id_mapel }}">
                        <label class="form-check-label" for="mapel{{ $m->id_mapel }}">
                          {{ $m->nama_mapel }}
                        </label>
                      </div>
                    </div>
                    @endforeach
                  </div>
                  @if($mapels->isEmpty())
                  <div id="mapel-empty" class="text-center text-muted py-2">
                    Belum ada mata pelajaran yang tersedia.
                  </div>
                  @endif
                </div>
              </div>

              <div class="d-grid mt-4">
                <button class="btn btn-submit">
                  <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                </button>
              </div>

              <div class="text-center mt-4">
                <a href="/" class="back-link">
                  <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                </a>
              </div>

            </form>

          </div>

        </div>

      </div>
    </div>

  </div>
</div>



</body>
</html>