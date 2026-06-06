<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bimbel Mentari | Belajar Lebih Terarah</title>
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
      background-color: #fdfdfd;
      background-image: radial-gradient(rgba(0, 51, 102, 0.03) 1px, transparent 1px);
      background-size: 30px 30px;
      color: var(--dark);
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* Navbar */
    .navbar {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(0,51,102,0.05);
      padding: 0.8rem 0;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar-brand img {
      transition: transform 0.3s ease;
    }
    
    .navbar-brand:hover img {
      transform: scale(1.05);
    }



    .nav-link {
      font-weight: 600;
      color: var(--navy) !important;
      margin: 0 0.5rem;
      padding: 0.5rem 1rem !important;
      transition: all 0.3s;
      border-radius: 8px;
    }

    .nav-link:hover {
      color: var(--yellow) !important;
      background: rgba(255,184,0,0.1);
    }

    .btn-daftar {
      background: linear-gradient(135deg, var(--yellow), var(--yellow-light));
      color: var(--navy) !important;
      font-weight: 700;
      padding: 0.7rem 1.8rem;
      border-radius: 50px;
      border: none;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(255,184,0,0.4);
    }
    .btn-cek-status {
  background: transparent;
  color: var(--navy) !important;
  font-weight: 700;
  padding: 0.7rem 1.4rem;
  border-radius: 50px;
  border: 2px solid var(--navy);
  transition: all 0.3s;
  text-decoration: none;
}

.btn-cek-status:hover {
  background: var(--navy);
  color: var(--white) !important;
  text-decoration: none;
  transform: translateY(-2px);
}

    .btn-daftar:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255,184,0,0.5);
      background: var(--navy);
      color: var(--white) !important;
    }

    .navbar-toggler {
      border: none;
      outline: none;
      color: var(--navy);
      font-size: 1.5rem;
    }

    .navbar-toggler:focus {
      outline: none;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(135deg, var(--navy) 0%, #001f3f 100%);
      color: var(--white);
      padding: 120px 0 100px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: -150px;
      right: -150px;
      width: 600px;
      height: 600px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,184,0,0.15) 0%, transparent 70%);
      z-index: 0;
    }

    .hero::after {
      content: '';
      position: absolute;
      bottom: -200px;
      left: -200px;
      width: 700px;
      height: 700px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255,184,0,0.08) 0%, transparent 70%);
      z-index: 0;
    }

    .hero .container {
      position: relative;
      z-index: 1;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.15);
      backdrop-filter: blur(10px);
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 500;
      margin-bottom: 1.5rem;
      border: 1px solid rgba(255,255,255,0.2);
    }

    .hero-badge i {
      color: var(--yellow);
    }

    .hero h1 {
      font-size: 3.2rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      line-height: 1.1;
      letter-spacing: -1px;
    }

    .hero h1 span {
      color: var(--yellow);
      display: block;
      margin-top: 0.5rem;
    }

    .hero-lead {
      font-size: 1.25rem;
      opacity: 0.9;
      margin-bottom: 2.5rem;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.6;
    }

    .hero-btns {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
      margin-bottom: 2rem;
    }

    .btn-hero {
      padding: 0.9rem 2.2rem;
      font-weight: 600;
      border-radius: 50px;
      transition: all 0.3s;
      font-size: 1rem;
    }

    .btn-primary-hero {
      background: var(--yellow);
      color: var(--navy);
      border: none;
    }

    .btn-primary-hero:hover {
      background: var(--white);
      transform: translateY(-3px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .btn-outline-hero {
      background: transparent;
      color: var(--white);
      border: 2px solid var(--white);
    }

    .btn-outline-hero:hover {
      background: var(--white);
      color: var(--navy);
      transform: translateY(-3px);
    }

    .hero-features {
      display: flex;
      gap: 1rem;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 2.5rem;
    }

    .feature-pill {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,255,255,0.1);
      padding: 0.6rem 1.2rem;
      border-radius: 50px;
      font-size: 0.9rem;
      backdrop-filter: blur(5px);
      border: 1px solid rgba(255,255,255,0.15);
    }

    .feature-pill i {
      color: var(--yellow);
    }

    /* Tentang Section */
    .tentang-section {
      background: var(--white);
      padding: 90px 0;
      position: relative;
      overflow: hidden;
    }

    .tentang-section::before {
      content: '';
      position: absolute;
      top: 70px;
      right: -120px;
      width: 260px;
      height: 260px;
      background: rgba(255,184,0,0.12);
      border-radius: 50%;
    }

    .tentang-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: rgba(255,184,0,0.15);
      color: var(--navy);
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 700;
      margin-bottom: 1.2rem;
    }

    .tentang-badge i {
      color: var(--yellow);
    }

    .tentang-title {
      font-size: 2.3rem;
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 1.2rem;
      line-height: 1.3;
    }

    .tentang-text {
      color: var(--gray);
      font-size: 1rem;
      line-height: 1.8;
      margin-bottom: 1rem;
    }

    .tentang-point {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .tentang-point-icon {
      width: 45px;
      height: 45px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--white);
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      box-shadow: 0 8px 20px rgba(255,184,0,0.3);
    }

    .tentang-point h5 {
      color: var(--navy);
      font-size: 1.05rem;
      font-weight: 700;
      margin-bottom: 0.3rem;
    }

    .tentang-point p {
      color: var(--gray);
      font-size: 0.95rem;
      margin: 0;
      line-height: 1.6;
    }

    .tentang-card {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
      border-radius: 28px;
      padding: 2.8rem;
      color: var(--white);
      position: relative;
      overflow: hidden;
      box-shadow: 0 18px 45px rgba(0,51,102,0.25);
    }

    .tentang-card::before {
      content: '';
      position: absolute;
      top: -70px;
      right: -70px;
      width: 220px;
      height: 220px;
      background: rgba(255,255,255,0.08);
      border-radius: 50%;
    }

    .tentang-card::after {
      content: '';
      position: absolute;
      bottom: -60px;
      left: -60px;
      width: 170px;
      height: 170px;
      background: rgba(255,184,0,0.16);
      border-radius: 50%;
    }

    .tentang-card-icon {
      width: 75px;
      height: 75px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--navy);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      margin-bottom: 1.5rem;
      position: relative;
      z-index: 1;
      box-shadow: 0 10px 25px rgba(255,184,0,0.35);
    }

    .tentang-card h3 {
      font-size: 1.8rem;
      font-weight: 800;
      margin-bottom: 1rem;
      position: relative;
      z-index: 1;
    }

    .tentang-card > p {
      color: rgba(255,255,255,0.85);
      line-height: 1.8;
      margin-bottom: 1.5rem;
      position: relative;
      z-index: 1;
    }

    .visi-misi-box {
      position: relative;
      z-index: 1;
      margin-top: 1.5rem;
    }

    .visi-misi-item {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      background: rgba(255,255,255,0.1);
      border: 1px solid rgba(255,255,255,0.12);
      padding: 1.2rem;
      border-radius: 18px;
      margin-bottom: 1rem;
      backdrop-filter: blur(8px);
    }

    .visi-misi-icon {
      width: 42px;
      height: 42px;
      background: var(--yellow);
      color: var(--navy);
      border-radius: 13px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .visi-misi-item h5 {
      color: var(--white);
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 0.3rem;
    }

    .visi-misi-item p {
      color: rgba(255,255,255,0.78);
      font-size: 0.9rem;
      line-height: 1.6;
      margin: 0;
    }

    .btn-tentang {
      display: inline-block;
      background: var(--yellow);
      color: var(--navy);
      padding: 0.85rem 2rem;
      font-weight: 700;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s;
      margin-top: 0.8rem;
      position: relative;
      z-index: 1;
      box-shadow: 0 8px 25px rgba(255,184,0,0.35);
    }

    .btn-tentang:hover {
      background: var(--white);
      color: var(--navy);
      text-decoration: none;
      transform: translateY(-3px);
    }

    /* Section Styling */
    .section {
      padding: 80px 0;
    }

    .section-title {
      font-size: 2.2rem;
      font-weight: 800;
      text-align: center;
      margin-bottom: 1rem;
      color: var(--navy);
    }

    .section-subtitle {
      text-align: center;
      color: var(--gray);
      font-size: 1.1rem;
      margin-bottom: 3rem;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    .bg-light-custom {
      background: var(--light);
    }

    /* Cards */
    .card-custom {
      background: var(--white);
      border-radius: 24px;
      padding: 3rem 2rem;
      height: 100%;
      border: 1px solid rgba(0,0,0,0.05);
      box-shadow: 0 10px 30px rgba(0,51,102,0.05);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .card-custom::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: var(--yellow);
      transform: scaleX(0);
      transition: transform 0.4s ease;
      transform-origin: left;
    }

    .card-custom:hover::before {
      transform: scaleX(1);
    }

    .card-custom:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 50px rgba(0,51,102,0.12);
    }

    .card-icon {
      width: 80px;
      height: 80px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      margin: 0 auto 1.5rem;
    }

    .card-icon.yellow {
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--white);
      box-shadow: 0 8px 25px rgba(255,184,0,0.35);
    }

    .card-icon.navy {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
      box-shadow: 0 8px 25px rgba(0,51,102,0.35);
    }

    .card-custom h5 {
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 1rem;
      font-size: 1.3rem;
    }

    .card-custom p {
      color: var(--gray);
      font-size: 0.95rem;
      line-height: 1.7;
      margin-bottom: 1rem;
    }

    .card-custom ul {
      list-style: none;
      padding: 0;
      margin: 1.5rem 0;
      text-align: left;
    }

    .card-custom ul li {
      padding: 0.5rem 0;
      color: var(--gray);
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 0.7rem;
    }

    .card-custom ul li::before {
      content: '✓';
      color: var(--yellow);
      font-weight: bold;
      font-size: 1.1rem;
    }

    .btn-program {
      display: inline-block;
      padding: 0.7rem 1.8rem;
      background: var(--navy);
      color: var(--white);
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s;
      margin-top: 1rem;
    }

    .btn-program:hover {
      background: var(--yellow);
      color: var(--navy);
      transform: translateY(-2px);
      text-decoration: none;
    }

    /* Alur Pendaftaran */
    .alur-section {
      background: var(--white);
      padding: 80px 0;
      position: relative;
      overflow: hidden;
    }

    .alur-section::before {
      content: '';
      position: absolute;
      top: -120px;
      left: -120px;
      width: 300px;
      height: 300px;
      background: rgba(255,184,0,0.12);
      border-radius: 50%;
    }

    .alur-section::after {
      content: '';
      position: absolute;
      bottom: -130px;
      right: -130px;
      width: 320px;
      height: 320px;
      background: rgba(0,51,102,0.08);
      border-radius: 50%;
    }

    .alur-wrapper {
      position: relative;
      z-index: 1;
    }

    .alur-card {
      background: var(--white);
      border-radius: 20px;
      padding: 2rem 1.5rem;
      height: 100%;
      text-align: center;
      box-shadow: 0 5px 20px rgba(0,51,102,0.08);
      transition: all 0.3s;
      position: relative;
      border: 1px solid rgba(0,51,102,0.05);
    }

    .alur-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 35px rgba(0,51,102,0.14);
    }

    .alur-number {
      width: 38px;
      height: 38px;
      background: var(--yellow);
      color: var(--navy);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.2rem;
      font-weight: 800;
      font-size: 0.9rem;
      box-shadow: 0 5px 15px rgba(255,184,0,0.3);
      border: 3px solid var(--white);
    }

    .alur-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--white);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.7rem;
      margin: 0 auto 1.3rem;
      box-shadow: 0 8px 25px rgba(255,184,0,0.35);
    }

    .alur-card h5 {
      color: var(--navy);
      font-weight: 800;
      font-size: 1.15rem;
      margin-bottom: 0.8rem;
    }

    .alur-card p {
      color: var(--gray);
      font-size: 0.92rem;
      line-height: 1.7;
      margin: 0;
    }

    .alur-info-box {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
      border-radius: 22px;
      padding: 2rem;
      margin-top: 3rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1.5rem;
      box-shadow: 0 12px 35px rgba(0,51,102,0.2);
    }

    .alur-info-box h4 {
      font-weight: 800;
      margin-bottom: 0.5rem;
    }

    .alur-info-box p {
      margin: 0;
      color: rgba(255,255,255,0.85);
      line-height: 1.7;
    }

    .btn-alur {
      background: var(--yellow);
      color: var(--navy);
      padding: 0.85rem 2rem;
      border-radius: 50px;
      font-weight: 800;
      text-decoration: none;
      white-space: nowrap;
      transition: all 0.3s;
      box-shadow: 0 8px 25px rgba(255,184,0,0.35);
    }

    .btn-alur:hover {
      background: var(--white);
      color: var(--navy);
      text-decoration: none;
      transform: translateY(-3px);
    }

    /* Feature List */
    .feature-item {
      background: var(--white);
      border-radius: 16px;
      padding: 2rem;
      display: flex;
      align-items: flex-start;
      gap: 1.5rem;
      box-shadow: 0 5px 20px rgba(0,51,102,0.08);
      transition: all 0.3s;
      margin-bottom: 1.5rem;
    }

    .feature-item:hover {
      transform: translateX(5px);
      box-shadow: 0 8px 30px rgba(0,51,102,0.12);
    }

    .feature-item-icon {
      width: 60px;
      height: 60px;
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      flex-shrink: 0;
    }

    .feature-item-icon.yellow {
      background: linear-gradient(135deg, var(--yellow), #FF9900);
      color: var(--white);
    }

    .feature-item-icon.navy {
      background: linear-gradient(135deg, var(--navy), var(--navy-light));
      color: var(--white);
    }

    .feature-item-content h5 {
      font-weight: 700;
      color: var(--navy);
      margin-bottom: 0.5rem;
      font-size: 1.2rem;
    }

    .feature-item-content p {
      color: var(--gray);
      margin: 0;
      line-height: 1.6;
    }

    /* CTA Section */
    .cta-section {
      background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
      color: var(--white);
      padding: 80px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,184,0,0.1) 0%, transparent 70%);
    }

    .cta-section h2 {
      font-size: 2.3rem;
      font-weight: 800;
      margin-bottom: 1rem;
      position: relative;
    }

    .cta-section p {
      font-size: 1.1rem;
      opacity: 0.95;
      margin-bottom: 2rem;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
      position: relative;
    }

    .btn-cta {
      background: var(--yellow);
      color: var(--navy);
      padding: 1rem 2.5rem;
      font-weight: 700;
      border-radius: 50px;
      border: none;
      font-size: 1.1rem;
      transition: all 0.3s;
      position: relative;
      box-shadow: 0 8px 25px rgba(255,184,0,0.4);
    }

    .btn-cta:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(255,184,0,0.5);
      background: var(--white);
      color: var(--navy);
      text-decoration: none;
    }

    /* Footer */
    .footer {
      background: var(--dark);
      color: rgba(255,255,255,0.8);
      padding: 60px 0 30px;
    }

    .footer-brand {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .footer p {
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 1.5rem;
    }

    .footer-title {
      color: var(--white);
      font-weight: 700;
      margin-bottom: 1.5rem;
      font-size: 1.1rem;
    }

    .footer-links li, .footer-contact li {
      margin-bottom: 0.8rem;
      font-size: 0.95rem;
      display: flex;
      align-items: flex-start;
    }

    .footer-links a {
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      transition: all 0.3s;
    }

    .footer-links a:hover {
      color: var(--yellow);
      padding-left: 5px;
    }

    .footer-contact li i {
      color: var(--yellow);
      margin-right: 12px;
      margin-top: 4px;
      width: 16px;
      text-align: center;
      flex-shrink: 0;
    }

    .footer-bottom {
      margin-top: 3rem;
      padding-top: 1.5rem;
      border-top: 1px solid rgba(255,255,255,0.1);
      font-size: 0.9rem;
      opacity: 0.7;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2rem;
      }
      
      .hero .lead {
        font-size: 1rem;
      }
      
      .hero-btns {
        flex-direction: column;
        align-items: center;
      }
      
      .hero-btns .btn {
        width: 100%;
        max-width: 300px;
      }
      
      .hero-features {
        flex-direction: column;
        align-items: center;
      }
      
      .section {
        padding: 60px 0;
      }

      .tentang-section {
        padding: 60px 0;
      }

      .tentang-title {
        font-size: 1.8rem;
      }

      .tentang-card {
        padding: 2rem 1.5rem;
        margin-top: 2rem;
      }

      .visi-misi-item {
        flex-direction: column;
      }
      
      .section-title {
        font-size: 1.8rem;
      }
      
      .card-custom {
        padding: 2rem 1.5rem;
        margin-bottom: 1.5rem;
      }

      .alur-section {
        padding: 60px 0;
      }

      .alur-card {
        margin-bottom: 1.5rem;
      }

      .alur-info-box {
        flex-direction: column;
        text-align: center;
      }

      .btn-alur {
        width: 100%;
        text-align: center;
      }
      
      .feature-item {
        flex-direction: column;
        text-align: center;
      }

      .feature-item-icon {
        margin: 0 auto;
      }

      .navbar-nav {
        margin-top: 1rem;
      }

      .nav-item.ml-3 {
        margin-left: 0 !important;
        margin-top: 0.8rem;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('images/logobimbel.png') }}" alt="Bimbel Mentari Logo" style="height: 65px; width: auto; object-fit: contain;">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
        <li class="nav-item"><a class="nav-link" href="#program">Program</a></li>
        <li class="nav-item"><a class="nav-link" href="#alur">Alur</a></li>
        <li class="nav-item"><a class="nav-link" href="#fasilitas">Fasilitas</a></li>
        <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
        <li class="nav-item ml-3">
          <li class="nav-item ml-3">
  <a href="/cek-status" class="btn btn-cek-status">
    <i class="fas fa-search mr-2"></i>Cek Status
  </a>
</li>

<li class="nav-item ml-3">
  <a href="/login" class="btn btn-cek-status">
    <i class="fas fa-right-to-bracket mr-2"></i>Login
  </a>
</li>

<li class="nav-item ml-2">
  <a href="/daftar" class="btn btn-daftar">
    <i class="fas fa-user-plus mr-2"></i>Daftar
  </a>
</li>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="container text-center">
    <div class="hero-badge">
      <i class="fas fa-map-marker-alt"></i>
      Jl. Raya Telkom Desa Panggung Baru Rt 01 Rw 01
    </div>

    <h1 class="hero-title">
      Sistem Informasi Bimbingan Belajar<br>
      <span>Bimbel Mentari</span>
    </h1>

    <p class="hero-lead">
      Platform manajemen bimbingan belajar modern untuk pengelolaan data siswa, jadwal, 
      materi, dan pembayaran dengan notifikasi WhatsApp otomatis.
    </p>
    
    <div class="hero-btns">
      <a href="/daftar" class="btn btn-hero btn-primary-hero">
        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
      </a>
      <a href="#program" class="btn btn-hero btn-outline-hero">
        <i class="fas fa-book mr-2"></i>Lihat Program
      </a>
    </div>

    <div class="hero-features">
      <div class="feature-pill">
        <i class="fas fa-shield-halved"></i>
        <span>Aman & Terpusat</span>
      </div>
      <div class="feature-pill">
        <i class="fas fa-whatsapp"></i>
        <span>Notifikasi WhatsApp</span>
      </div>
      <div class="feature-pill">
        <i class="fas fa-clock"></i>
        <span>Jadwal Real-time</span>
      </div>
    </div>
  </div>
</section>

<!-- Tentang Section -->
<section id="tentang" class="tentang-section">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="tentang-badge">
          <i class="fas fa-info-circle"></i>
          Tentang Kami
        </div>

        <h2 class="tentang-title">Mengenal Bimbel Mentari</h2>

        <p class="tentang-text">
          Bimbel Mentari adalah lembaga bimbingan belajar yang membantu siswa SD,
          SMP, dan SMA dalam memahami pelajaran sekolah dengan lebih terarah,
          terstruktur, dan menyenangkan.
        </p>

        <p class="tentang-text">
          Melalui sistem informasi berbasis Laravel, proses pengelolaan data siswa,
          jadwal belajar, materi, pembayaran, dan pengingat pembayaran melalui
          WhatsApp dapat dilakukan dengan lebih mudah, cepat, dan efisien.
        </p>

        <div class="tentang-point">
          <div class="tentang-point-icon">
            <i class="fas fa-check"></i>
          </div>
          <div>
            <h5>Belajar Lebih Terarah</h5>
            <p>Siswa mendapatkan bimbingan sesuai jenjang pendidikan dan kebutuhan belajar masing-masing.</p>
          </div>
        </div>

        <div class="tentang-point">
          <div class="tentang-point-icon">
            <i class="fas fa-check"></i>
          </div>
          <div>
            <h5>Sistem Lebih Praktis</h5>
            <p>Data siswa, jadwal, materi, dan pembayaran dapat dikelola melalui satu platform.</p>
          </div>
        </div>

        <div class="tentang-point">
          <div class="tentang-point-icon">
            <i class="fas fa-wallet"></i>
          </div>
          <div>
            <h5>Biaya Terjangkau</h5>
            <p>Investasi pendidikan yang sangat terjangkau, hanya <strong>Rp. 30.000 / bulan</strong> untuk semua jenjang.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="tentang-card">
          <div class="tentang-card-icon">
            <i class="fas fa-sun"></i>
          </div>

          <h3>Bimbel Mentari</h3>

          <p>
            Hadir sebagai solusi pengelolaan bimbingan belajar untuk membantu
            admin mengelola data bimbel serta memudahkan siswa dan orang tua
            memperoleh informasi terkait jadwal dan pembayaran.
          </p>

          <div class="visi-misi-box">
            <div class="visi-misi-item">
              <div class="visi-misi-icon">
                <i class="fas fa-bullseye"></i>
              </div>
              <div>
                <h5>Visi</h5>
                <p>
                  Menjadi bimbingan belajar yang membantu siswa berkembang melalui
                  pembelajaran yang terarah dan sistem informasi yang mudah digunakan.
                </p>
              </div>
            </div>

            <div class="visi-misi-item">
              <div class="visi-misi-icon">
                <i class="fas fa-list-check"></i>
              </div>
              <div>
                <h5>Misi</h5>
                <p>
                  Memberikan layanan belajar yang berkualitas, jadwal yang jelas,
                  serta informasi pembayaran yang lebih tertata dan transparan.
                </p>
              </div>
            </div>
          </div>

          <a href="#program" class="btn-tentang">
            Lihat Program <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Program Section -->
<section id="program" class="section">
  <div class="container">
    <h2 class="section-title">Program Belajar</h2>
    <p class="section-subtitle">Bimbingan terstruktur untuk SD, SMP, dan SMA dengan tutor berpengalaman</p>

    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card-custom">
          <div class="card-icon yellow">
            <i class="fas fa-child"></i>
          </div>
          <h5>Program SD</h5>
          <p>Kelas 1 - 6</p>
          <ul>
            <li>Matematika Dasar</li>
            <li>Bahasa Indonesia</li>
            <li>IPA Terpadu</li>
            <li>Persiapan Ujian Sekolah</li>
            <li><strong style="color: var(--navy);">Biaya: Rp. 30.000 / bulan</strong></li>
          </ul>
          <a href="/program/sd" class="btn-program">Lihat Detail</a>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card-custom">
          <div class="card-icon navy">
            <i class="fas fa-user-graduate"></i>
          </div>
          <h5>Program SMP</h5>
          <p>Kelas 7 - 9</p>
          <ul>
            <li>Matematika & Statistika</li>
            <li>IPA (Fisika, Biologi)</li>
            <li>Bahasa Inggris</li>
            <li>Latihan Soal Terstruktur</li>
            <li><strong style="color: var(--navy);">Biaya: Rp. 30.000 / bulan</strong></li>
          </ul>
          <a href="/program/smp" class="btn-program">Lihat Detail</a>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card-custom">
          <div class="card-icon yellow">
            <i class="fas fa-university"></i>
          </div>
          <h5>Program SMA</h5>
          <p>Kelas 10 - 12</p>
          <ul>
            <li>Matematika Peminatan</li>
            <li>Fisika / Kimia / Biologi</li>
            <li>Bahasa Inggris</li>
            <li>Persiapan UTBK/SNBT</li>
            <li><strong style="color: var(--navy);">Biaya: Rp. 30.000 / bulan</strong></li>
          </ul>
          <a href="/program/sma" class="btn-program">Lihat Detail</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Alur Pendaftaran Section -->
<section id="alur" class="alur-section">
  <div class="container alur-wrapper">
    <h2 class="section-title">Alur Pendaftaran</h2>
    <p class="section-subtitle">
      Daftar bimbingan belajar di Bimbel Mentari dengan proses yang mudah dan terarah
    </p>

    <div class="row">
      <div class="col-lg col-md-6 mb-4">
        <div class="alur-card">
          <div class="alur-number">1</div>
          <div class="alur-icon">
            <i class="fas fa-book-open"></i>
          </div>
          <h5>Pilih Program</h5>
          <p>
            Calon siswa memilih program belajar sesuai jenjang pendidikan,
            yaitu SD, SMP, atau SMA.
          </p>
        </div>
      </div>

      <div class="col-lg col-md-6 mb-4">
        <div class="alur-card">
          <div class="alur-number">2</div>
          <div class="alur-icon">
            <i class="fas fa-file-signature"></i>
          </div>
          <h5>Isi Formulir</h5>
          <p>
            Calon siswa mengisi data pendaftaran seperti nama, kelas,
            nomor WhatsApp, alamat, dan program yang dipilih.
          </p>
        </div>
      </div>

      <div class="col-lg col-md-6 mb-4">
        <div class="alur-card">
          <div class="alur-number">3</div>
          <div class="alur-icon">
            <i class="fas fa-clipboard-check"></i>
          </div>
          <h5>Verifikasi Data</h5>
          <p>
            Admin memeriksa data pendaftaran yang telah dikirim oleh
            calon siswa atau orang tua.
          </p>
        </div>
      </div>

      <div class="col-lg col-md-6 mb-4">
        <div class="alur-card">
          <div class="alur-number">4</div>
          <div class="alur-icon">
            <i class="fas fa-calendar-check"></i>
          </div>
          <h5>Penentuan Jadwal</h5>
          <p>
            Setelah data diverifikasi, siswa akan mendapatkan informasi
            jadwal belajar sesuai program yang dipilih.
          </p>
        </div>
      </div>

      <div class="col-lg col-md-6 mb-4">
        <div class="alur-card">
          <div class="alur-number">5</div>
          <div class="alur-icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h5>Mulai Belajar</h5>
          <p>
            Siswa mulai mengikuti kegiatan bimbingan belajar sesuai
            jadwal yang telah ditentukan.
          </p>
        </div>
      </div>
    </div>

    <div class="alur-info-box">
      <div>
        <h4>Ingin mendaftar sekarang?</h4>
        <p>
          Klik tombol daftar dan isi data pendaftaran. Nomor WhatsApp digunakan
          sebagai media penerimaan notifikasi atau pengingat pembayaran.
        </p>
      </div>
      <a href="/daftar" class="btn-alur">
        <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
      </a>
    </div>
  </div>
</section>

<!-- Fasilitas Section -->
<section id="fasilitas" class="section bg-light-custom">
  <div class="container">
    <h2 class="section-title">Fitur Sistem</h2>
    <p class="section-subtitle">Mengapa menggunakan sistem Bimbel Mentari?</p>

    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="feature-item">
          <div class="feature-item-icon yellow">
            <i class="fas fa-bell"></i>
          </div>
          <div class="feature-item-content">
            <h5>Pengingat Pembayaran WhatsApp</h5>
            <p>Sistem dapat mengirim notifikasi atau pengingat pembayaran melalui WhatsApp kepada siswa atau orang tua.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 mb-4">
        <div class="feature-item">
          <div class="feature-item-icon navy">
            <i class="fas fa-file-invoice-dollar"></i>
          </div>
          <div class="feature-item-content">
            <h5>Pengelolaan Pembayaran</h5>
            <p>Data pembayaran siswa dapat dicatat dan dikelola oleh admin dengan lebih rapi dan terstruktur.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 mb-4">
        <div class="feature-item">
          <div class="feature-item-icon yellow">
            <i class="fas fa-database"></i>
          </div>
          <div class="feature-item-content">
            <h5>Data Terpusat</h5>
            <p>Data siswa, jadwal, materi, dan pembayaran tersimpan dalam satu sistem sehingga lebih mudah dikelola.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 mb-4">
        <div class="feature-item">
          <div class="feature-item-icon navy">
            <i class="fas fa-calendar-check"></i>
          </div>
          <div class="feature-item-content">
            <h5>Informasi Jadwal Belajar</h5>
            <p>Jadwal kegiatan bimbingan belajar dapat dicatat dan ditampilkan melalui sistem sesuai program yang diikuti siswa.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="container">
    <h2>Siap Bergabung dengan Bimbel Mentari?</h2>
    <p>Daftarkan diri Anda sekarang. Nomor WhatsApp digunakan untuk menerima pengingat pembayaran dari sistem.</p>
    <a href="/daftar" class="btn btn-cta">
      <i class="fas fa-arrow-right mr-2"></i>Daftar Sekarang
    </a>
  </div>
</section>

<!-- Footer -->
<footer id="kontak" class="footer">
  <div class="container">
    <div class="row text-left">
      <!-- Deskripsi -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="footer-brand">
          <img src="{{ asset('images/logobimbel.png') }}" alt="Bimbel Mentari Logo" style="height: 50px; width: auto; border-radius: 8px; margin-right: 15px;">
          <h4 style="color: var(--white); font-weight: 700; margin: 0; font-size: 1.2rem;">Bimbel Mentari</h4>
        </div>
        <p>Membantu pengelolaan data siswa, jadwal belajar, dan layanan bimbingan belajar secara lebih mudah, cepat, dan modern.</p>
      </div>

      <!-- Kontak -->
      <div class="col-lg-3 col-md-6 mb-4">
        <h5 class="footer-title">Kontak</h5>
        <ul class="list-unstyled footer-contact">
          <li><i class="fab fa-whatsapp"></i> 000000000000</li>
          <li><i class="fas fa-envelope"></i> bimbelmentari@gmail.com</li>
          <li><i class="fas fa-map-marker-alt"></i> Jl. Raya Telkom Desa Panggung Baru Rt 01 Rw 01</li>
        </ul>
      </div>

      <!-- Jam Operasional -->
      <div class="col-lg-3 col-md-6 mb-4">
        <h5 class="footer-title">Jam Operasional</h5>
        <ul class="list-unstyled footer-contact">
          <li><i class="far fa-clock"></i> Senin – Jumat : 13.00 – 17.00 WIB</li>
          <li><i class="far fa-clock"></i> Sabtu : 10.00 – 17.00 WIB</li>
          <li><i class="far fa-calendar-times"></i> Minggu : <span class="text-danger font-weight-bold ml-1">Libur</span></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom text-center">
      <p class="mb-0">&copy; 2026 Sistem Informasi Bimbel Mentari<br>All Rights Reserved</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>