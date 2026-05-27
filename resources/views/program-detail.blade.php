<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $program['nama'] }} | Bimbel Mentari</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

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
      background: var(--light);
      color: var(--dark);
      line-height: 1.6;
      overflow-x: hidden;
    }

    .navbar {
      background: var(--white);
      box-shadow: 0 2px 20px rgba(0,51,102,0.1);
      padding: 1rem 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      text-decoration: none;
    }

    .logo-icon {
      width: 45px;
      height: 45px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--navy);
      font-size: 1.5rem;
      box-shadow: 0 4px 12px rgba(255,184,0,0.3);
    }

    .brand-text {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
    }

    .brand-text small {
      font-size: 0.65rem;
      letter-spacing: 3px;
      color: var(--navy);
      font-weight: 600;
      text-transform: uppercase;
    }

    .brand-text strong {
      font-size: 1.3rem;
      font-weight: 800;
      color: var(--navy);
      letter-spacing: 1px;
    }

    .brand-text strong span {
      color: var(--yellow);
    }

    .btn-back {
      background: var(--navy);
      color: var(--white);
      padding: 0.75rem 1.8rem;
      border-radius: 50px;
      font-weight: 700;
      text-decoration: none;
      transition: all 0.3s;
    }

    .btn-back:hover {
      background: var(--yellow);
      color: var(--navy);
      text-decoration: none;
      transform: translateY(-2px);
    }

    .hero-detail {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
      padding: 90px 0;
      position: relative;
      overflow: hidden;
    }

    .hero-detail::before {
      content: '';
      position: absolute;
      top: -120px;
      right: -120px;
      width: 430px;
      height: 430px;
      background: rgba(255,184,0,0.12);
      border-radius: 50%;
    }

    .hero-detail::after {
      content: '';
      position: absolute;
      bottom: -150px;
      left: -150px;
      width: 450px;
      height: 450px;
      background: rgba(255,255,255,0.06);
      border-radius: 50%;
    }

    .hero-content {
      position: relative;
      z-index: 1;
    }

    .detail-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.15);
      padding: 0.55rem 1.2rem;
      border-radius: 50px;
      border: 1px solid rgba(255,255,255,0.18);
      font-weight: 600;
      margin-bottom: 1.2rem;
    }

    .detail-badge i {
      color: var(--yellow);
    }

    .hero-detail h1 {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 0.8rem;
    }

    .hero-detail h4 {
      color: var(--yellow);
      font-weight: 700;
      margin-bottom: 1.2rem;
    }

    .hero-detail p {
      color: rgba(255,255,255,0.88);
      font-size: 1.05rem;
      line-height: 1.8;
      max-width: 720px;
      margin-bottom: 2rem;
    }

    .hero-icon {
      width: 150px;
      height: 150px;
      border-radius: 35px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--white);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 4rem;
      margin-left: auto;
      box-shadow: 0 20px 45px rgba(255,184,0,0.35);
      position: relative;
      z-index: 1;
    }

    .btn-daftar-detail {
      display: inline-block;
      background: var(--yellow);
      color: var(--navy);
      padding: 0.9rem 2.2rem;
      border-radius: 50px;
      font-weight: 800;
      text-decoration: none;
      transition: all 0.3s;
      box-shadow: 0 10px 25px rgba(255,184,0,0.35);
    }

    .btn-daftar-detail:hover {
      background: var(--white);
      color: var(--navy);
      text-decoration: none;
      transform: translateY(-3px);
    }

    .section-detail {
      padding: 80px 0;
    }

    .section-title {
      font-size: 2.1rem;
      font-weight: 800;
      color: var(--navy);
      text-align: center;
      margin-bottom: 1rem;
    }

    .section-subtitle {
      color: var(--gray);
      text-align: center;
      max-width: 650px;
      margin: 0 auto 3rem;
    }

    .info-card {
      background: var(--white);
      border-radius: 24px;
      padding: 2.2rem;
      height: 100%;
      box-shadow: 0 8px 25px rgba(0,51,102,0.08);
      border: 1px solid rgba(0,51,102,0.05);
      transition: all 0.3s;
    }

    .info-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 40px rgba(0,51,102,0.13);
    }

    .info-card h4 {
      color: var(--navy);
      font-weight: 800;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.8rem;
      font-size: 1.35rem;
    }

    .info-card h4 i {
      width: 45px;
      height: 45px;
      background: var(--yellow);
      color: var(--navy);
      border-radius: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .list-detail {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .list-detail li {
      display: flex;
      align-items: flex-start;
      gap: 0.8rem;
      padding: 0.75rem 0;
      color: var(--gray);
      line-height: 1.7;
      border-bottom: 1px solid rgba(0,51,102,0.06);
    }

    .list-detail li:last-child {
      border-bottom: none;
    }

    .list-detail li i {
      color: var(--yellow);
      margin-top: 5px;
      flex-shrink: 0;
    }

    .highlight-section {
      background: var(--white);
      padding: 80px 0;
    }

    .highlight-card {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
      border-radius: 26px;
      padding: 2.5rem;
      height: 100%;
      box-shadow: 0 15px 35px rgba(0,51,102,0.18);
      position: relative;
      overflow: hidden;
    }

    .highlight-card::before {
      content: '';
      position: absolute;
      width: 180px;
      height: 180px;
      background: rgba(255,184,0,0.15);
      border-radius: 50%;
      top: -60px;
      right: -60px;
    }

    .highlight-card h3 {
      font-weight: 800;
      margin-bottom: 1rem;
      position: relative;
      z-index: 1;
    }

    .highlight-card p {
      color: rgba(255,255,255,0.85);
      line-height: 1.8;
      margin: 0;
      position: relative;
      z-index: 1;
    }

    .small-feature {
      background: var(--white);
      border-radius: 18px;
      padding: 1.5rem;
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      box-shadow: 0 8px 25px rgba(0,51,102,0.08);
      height: 100%;
    }

    .small-feature-icon {
      width: 55px;
      height: 55px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--white);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
      flex-shrink: 0;
    }

    .small-feature h5 {
      color: var(--navy);
      font-weight: 800;
      margin-bottom: 0.4rem;
    }

    .small-feature p {
      color: var(--gray);
      margin: 0;
      font-size: 0.95rem;
      line-height: 1.6;
    }

    .cta-detail {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
      padding: 75px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .cta-detail::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,184,0,0.12) 0%, transparent 70%);
    }

    .cta-detail h2 {
      font-weight: 800;
      font-size: 2.2rem;
      margin-bottom: 1rem;
      position: relative;
    }

    .cta-detail p {
      max-width: 650px;
      margin: 0 auto 2rem;
      color: rgba(255,255,255,0.88);
      position: relative;
    }

    .footer {
      background: var(--dark);
      color: rgba(255,255,255,0.8);
      padding: 40px 0 30px;
      text-align: center;
    }

    .footer-brand {
      font-size: 1.4rem;
      font-weight: 800;
      color: var(--white);
      margin-bottom: 1rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .footer-brand i {
      color: var(--yellow);
    }

    .footer p {
      margin-bottom: 0.5rem;
      opacity: 0.9;
    }

    .footer-bottom {
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(255,255,255,0.1);
      font-size: 0.9rem;
      opacity: 0.7;
    }

    @media (max-width: 768px) {
      .navbar .container {
        flex-direction: column;
        gap: 1rem;
      }

      .hero-detail {
        padding: 70px 0;
        text-align: center;
      }

      .hero-detail h1 {
        font-size: 2.2rem;
      }

      .hero-icon {
        margin: 2rem auto 0;
        width: 120px;
        height: 120px;
        font-size: 3rem;
      }

      .section-detail,
      .highlight-section {
        padding: 60px 0;
      }

      .info-card {
        margin-bottom: 1.5rem;
      }

      .small-feature {
        margin-bottom: 1.5rem;
      }

      .cta-detail h2 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>
<body>

<nav class="navbar">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="/">
      <div class="logo-icon">
        <i class="fas fa-sun"></i>
      </div>
      <div class="brand-text">
        <small>BIMBEL</small>
        <strong>MEN<span>T</span>ARI</strong>
      </div>
    </a>

    <a href="/#program" class="btn-back">
      <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
  </div>
</nav>

<section class="hero-detail">
  <div class="container hero-content">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="detail-badge">
          <i class="fas fa-book-open"></i>
          Detail Program Belajar
        </div>

        <h1>{{ $program['nama'] }}</h1>
        <h4>{{ $program['kelas'] }}</h4>

        <p>{{ $program['deskripsi'] }}</p>

        <a href="/daftar?program={{ $slug }}" class="btn-daftar-detail">
          <i class="fas fa-user-plus mr-2"></i>Daftar Program Ini
        </a>
      </div>

      <div class="col-lg-4">
        <div class="hero-icon">
          <i class="{{ $program['icon'] ?? 'fas fa-book-open' }}"></i>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-detail">
  <div class="container">
    <h2 class="section-title">Informasi Program</h2>
    <p class="section-subtitle">
      Program ini disusun untuk membantu siswa belajar lebih terarah sesuai jenjang pendidikan.
    </p>

    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="info-card">
          <h4>
            <i class="fas fa-book"></i>
            Materi Belajar
          </h4>

          <ul class="list-detail">
            @foreach (($program['materi'] ?? []) as $materi)
              <li>
                <i class="fas fa-check"></i>
                <span>{{ $materi }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="info-card">
          <h4>
            <i class="fas fa-star"></i>
            Keunggulan Program
          </h4>

          <ul class="list-detail">
            @foreach (($program['keunggulan'] ?? []) as $item)
              <li>
                <i class="fas fa-check-circle"></i>
                <span>{{ $item }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="highlight-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 mb-4 mb-lg-0">
        <div class="highlight-card">
          <h3>Mengapa Memilih {{ $program['nama'] }}?</h3>
          <p>
            Program ini membantu siswa belajar dengan lebih fokus melalui materi yang
            disesuaikan dengan jenjang pendidikan, latihan soal terarah, serta dukungan
            sistem informasi untuk memantau jadwal dan informasi belajar.
          </p>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="small-feature">
              <div class="small-feature-icon">
                <i class="fas fa-calendar-check"></i>
              </div>
              <div>
                <h5>Jadwal Terarah</h5>
                <p>Jadwal belajar dapat diatur dan dipantau melalui sistem.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-4">
            <div class="small-feature">
              <div class="small-feature-icon">
                <i class="fas fa-bell"></i>
              </div>
              <div>
                <h5>Notifikasi WhatsApp</h5>
                <p>Informasi penting dapat dikirim melalui WhatsApp.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-4">
            <div class="small-feature">
              <div class="small-feature-icon">
                <i class="fas fa-user-graduate"></i>
              </div>
              <div>
                <h5>Belajar Terstruktur</h5>
                <p>Materi disusun sesuai kebutuhan siswa pada jenjangnya.</p>
              </div>
            </div>
          </div>

          <div class="col-md-6 mb-4">
            <div class="small-feature">
              <div class="small-feature-icon">
                <i class="fas fa-database"></i>
              </div>
              <div>
                <h5>Data Terpusat</h5>
                <p>Data siswa, jadwal, materi, dan pembayaran lebih mudah dikelola.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="cta-detail">
  <div class="container">
    <h2>Tertarik Mengikuti {{ $program['nama'] }}?</h2>
    <p>
      Daftar sekarang dan admin akan membantu proses pendaftaran serta memberikan
      informasi lanjutan melalui WhatsApp.
    </p>

    <a href="/daftar?program={{ $slug }}" class="btn-daftar-detail">
      <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
    </a>
  </div>
</section>

<footer class="footer">
  <div class="container">
    <div class="footer-brand">
      <i class="fas fa-sun"></i>
      Bimbel Mentari
    </div>
    <p>Desa Panggung Baru, Tanah Laut</p>
    <p>Sistem Informasi Berbasis Laravel Terintegrasi WhatsApp</p>
    <div class="footer-bottom">
      <p>&copy; 2025 Bimbel Mentari. Tugas Akhir - Suchi Aprilia (2301301111)</p>
      <p>Politeknik Negeri Tanah Laut</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>