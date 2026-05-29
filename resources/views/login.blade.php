<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Bimbel Mentari</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background:
                radial-gradient(circle at 90% 0%, #fff1bf 0 13%, transparent 14%),
                radial-gradient(circle at 10% 95%, #dfeaf3 0 12%, transparent 13%),
                linear-gradient(135deg, #f7fbff, #eef5fb);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px;
            color: #073763;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1120px;
            min-height: 640px;
            background: #fff;
            border-radius: 34px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 42% 58%;
            box-shadow: 0 25px 60px rgba(7, 55, 99, .16);
        }

        .left-panel {
            position: relative;
            background: linear-gradient(160deg, #003b70, #064b86);
            color: white;
            padding: 56px;
            overflow: hidden;
        }

        .left-panel::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            right: -45px;
            top: -45px;
        }

        .left-panel::after {
            content: "";
            position: absolute;
            width: 170px;
            height: 170px;
            border-radius: 50%;
            background: rgba(255,193,7,.18);
            left: -60px;
            bottom: -55px;
        }

        .logo-box {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 62px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: #ffc107;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #063b6b;
            font-size: 31px;
            box-shadow: 0 12px 25px rgba(255,193,7,.25);
        }

        .logo-text small {
            display: block;
            letter-spacing: 7px;
            font-weight: 700;
            font-size: 12px;
        }

        .logo-text strong {
            display: block;
            font-size: 34px;
            line-height: 1;
            font-weight: 800;
        }

        .left-panel h1 {
            position: relative;
            z-index: 2;
            font-size: 40px;
            line-height: 1.22;
            margin: 0 0 24px;
            font-weight: 800;
        }

        .left-panel p {
            position: relative;
            z-index: 2;
            margin: 0 0 42px;
            color: rgba(255,255,255,.82);
            font-size: 17px;
            line-height: 1.8;
        }

        .feature {
            position: relative;
            z-index: 2;
            display: flex;
            gap: 18px;
            margin-bottom: 26px;
        }

        .feature i {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #ffc107;
            color: #073763;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 19px;
        }

        .feature h3 {
            margin: 0 0 4px;
            font-size: 18px;
        }

        .feature span {
            color: rgba(255,255,255,.78);
            font-size: 14px;
            line-height: 1.6;
        }

        .right-panel {
            padding: 68px 72px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-box {
            width: 100%;
            max-width: 510px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: #fff4d4;
            color: #073763;
            padding: 11px 22px;
            border-radius: 999px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-box h2 {
            font-size: 42px;
            line-height: 1.2;
            margin: 0 0 14px;
            font-weight: 800;
            color: #073763;
        }

        .desc {
            color: #7b8490;
            font-size: 17px;
            line-height: 1.8;
            margin-bottom: 34px;
        }

        label {
            display: block;
            font-weight: 700;
            margin-bottom: 9px;
            color: #073763;
        }

        .input-group {
            position: relative;
            margin-bottom: 22px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 18px;
            transform: translateY(-50%);
            color: #9aa5b1;
        }

        .input-group i.toggle-password {
            left: auto;
            right: 18px;
            cursor: pointer;
        }

        input {
            width: 100%;
            height: 58px;
            border: 1.5px solid #e3e9ef;
            border-radius: 16px;
            padding: 0 18px 0 50px;
            font-size: 15px;
            font-family: inherit;
            outline: none;
            transition: .2s;
        }

        input.password-input {
            padding-right: 50px;
        }

        input:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 4px rgba(255,193,7,.18);
        }

        .btn-login {
            width: 100%;
            height: 62px;
            border: none;
            border-radius: 999px;
            background: linear-gradient(135deg, #ffb800, #ffd23f);
            color: #073763;
            font-size: 17px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 18px 30px rgba(255, 193, 7, .35);
            margin-top: 8px;
            transition: .2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 36px rgba(255, 193, 7, .45);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 26px;
            color: #7b8490;
            font-weight: 700;
            text-decoration: none;
        }

        .back-link:hover {
            color: #073763;
        }

        .error {
            background: #ffe8e8;
            color: #d62828;
            border-radius: 14px;
            padding: 13px 16px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            .login-wrapper {
                grid-template-columns: 1fr;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                padding: 45px 26px;
            }

            .form-box h2 {
                font-size: 34px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="left-panel">
        <div class="logo-box">
            <div class="logo-icon">
                <i class="fa-solid fa-sun"></i>
            </div>
            <div class="logo-text">
                <small>BIMBEL</small>
                <strong>MENTARI</strong>
            </div>
        </div>

        <h1>Masuk ke Sistem<br>Bimbel Mentari</h1>
        <p>
            Gunakan nomor WhatsApp dan password untuk mengakses dashboard sesuai role pengguna.
        </p>

        <div class="feature">
            <i class="fa-solid fa-user-shield"></i>
            <div>
                <h3>Akses Admin</h3>
                <span>Kelola data siswa, guru, kelas, jadwal, pembayaran, dan pendaftaran.</span>
            </div>
        </div>

        <div class="feature">
            <i class="fa-solid fa-chalkboard-user"></i>
            <div>
                <h3>Akses Guru</h3>
                <span>Melihat jadwal mengajar dan mengelola materi pembelajaran.</span>
            </div>
        </div>

        <div class="feature">
            <i class="fa-solid fa-graduation-cap"></i>
            <div>
                <h3>Akses Siswa / Orang Tua</h3>
                <span>Melihat jadwal, materi, dan status pembayaran.</span>
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="form-box">
            <div class="badge">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login Pengguna
            </div>

            <h2>Selamat Datang</h2>
            <p class="desc">
                Masukkan nomor WhatsApp dan password untuk masuk ke dashboard Bimbel Mentari.
            </p>

            {{-- ALERT SUCCESS (LOGOUT) --}}
@if(session('success'))
    <div style="background:#d4edda; color:#155724; padding:13px 16px; border-radius:14px; margin-bottom:20px; font-weight:600;">
        {{ session('success') }}
    </div>
@endif

{{-- ALERT ERROR (LOGIN GAGAL) --}}
@if(session('error'))
    <div class="error">{{ session('error') }}</div>
@endif

            <form method="POST" action="/login">
                @csrf

                <label>No WhatsApp</label>
                <div class="input-group">
                    <i class="fa-brands fa-whatsapp"></i>
                    <input type="text" name="no_wa" placeholder="Contoh: 081234567890" required>
                </div>

                <label>Password</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" class="password-input" placeholder="Masukkan password" required>
                    <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
                </div>

                <button class="btn-login" type="submit">
                    <i class="fa-solid fa-paper-plane"></i> Masuk Sekarang
                </button>
            </form>

            <a href="/" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
        this.classList.toggle('fa-eye');
    });
</script>

</body>
</html>