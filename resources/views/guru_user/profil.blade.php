@extends('guru_user.layout')

@section('content')
    <style>
        .profile-page {
            max-width: 1080px;
            margin: auto;
            display: grid;
            gap: 28px;
            padding: 20px 0;
        }

        .profile-hero {
            background: #f5f9ff;
            border-radius: 28px;
            padding: 30px 32px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            box-shadow: 0 20px 45px rgba(7, 55, 99, 0.06);
        }

        .profile-hero .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #e3efff;
            color: #0f4bbd;
            font-weight: 700;
            padding: 10px 16px;
            border-radius: 999px;
            margin-bottom: 14px;
            font-size: 14px;
        }

        .profile-hero h1 {
            margin: 0;
            font-size: 34px;
            line-height: 1.1;
            color: #072d54;
        }

        .profile-hero p {
            margin: 12px 0 0;
            color: #5d6b7e;
            max-width: 640px;
            line-height: 1.7;
        }

        .status-badge {
            padding: 12px 20px;
            background: #d7f3e3;
            color: #1f7c4d;
            border-radius: 999px;
            font-weight: 700;
            min-width: 110px;
            text-align: center;
            box-shadow: inset 0 0 0 1px rgba(31, 124, 77, 0.12);
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 26px;
        }

        .profile-card,
        .profile-form-card,
        .password-card {
            background: white;
            border-radius: 28px;
            padding: 30px;
            box-shadow: 0 18px 40px rgba(7, 55, 99, 0.08);
        }

        .profile-summary {
            display: grid;
            gap: 24px;
        }

        .profile-avatar {
            width: 100%;
            min-height: 220px;
            border-radius: 24px;
            background: linear-gradient(180deg, #0d6efd 0%, #2563eb 100%);
            color: white;
            display: grid;
            place-items: center;
            font-size: 64px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.12);
        }

        .profile-summary h2 {
            margin: 0;
            font-size: 26px;
            color: #072d54;
        }

        .profile-summary p {
            margin: 8px 0 0;
            color: #5d6b7e;
            line-height: 1.75;
        }

        .profile-metadata {
            display: grid;
            gap: 14px;
        }

        .meta-item {
            display: grid;
            gap: 4px;
        }

        .meta-item label {
            font-size: 13px;
            color: #5d6b7e;
            font-weight: 700;
        }

        .meta-item span {
            color: #0f2b4c;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-form-card h2,
        .password-card h2 {
            margin: 0 0 12px;
            font-size: 22px;
            color: #072d54;
        }

        .profile-form-card p,
        .password-card p {
            margin: 0 0 24px;
            color: #5d6b7e;
            line-height: 1.75;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field-group {
            display: grid;
            gap: 10px;
        }

        .field-group label {
            font-weight: 700;
            color: #253653;
        }

        .field-group input,
        .field-group textarea {
            width: 100%;
            border: 1px solid #d8e0ea;
            border-radius: 16px;
            padding: 14px 16px;
            background: #f8fafc;
            color: #072d54;
            transition: border-color 0.2s ease;
        }

        .field-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .field-group input:focus,
        .field-group textarea:focus {
            outline: none;
            border-color: #0d6efd;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn-secondary,
        .btn-primary,
        .btn-warning {
            border: none;
            border-radius: 999px;
            padding: 12px 22px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary {
            background: #0d6efd;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #11233d;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #253653;
        }

        .btn-primary:hover,
        .btn-warning:hover,
        .btn-secondary:hover {
            transform: translateY(-1px);
        }

        .alert-box {
            border-radius: 18px;
            padding: 18px 22px;
            margin-bottom: 22px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #e9f7ef;
            color: #1f7c49;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
        }

        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            justify-content: center;
            align-items: center;
            padding: 20px;
            z-index: 20;
        }

        .modal-backdrop.active {
            display: flex;
        }

        .modal-card {
            background: white;
            border-radius: 26px;
            width: 100%;
            max-width: 480px;
            padding: 28px;
            box-shadow: 0 28px 65px rgba(7, 55, 99, 0.16);
        }

        .modal-card h3 {
            margin: 0 0 8px;
            color: #072d54;
            font-size: 22px;
        }

        .modal-card p {
            margin: 0 0 20px;
            color: #5d6b7e;
            line-height: 1.7;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            flex-wrap: wrap;
        }

        @media (max-width: 920px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 680px) {
            .profile-hero {
                flex-direction: column;
                align-items: stretch;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                justify-content: stretch;
            }
        }
    </style>

    <div class="profile-page">
        <section class="profile-hero">
            <div>
                <span class="hero-label"><i class="fa-solid fa-id-badge"></i> Profil Guru</span>
                <h1>Kelola akun dan data pribadi Anda</h1>
                <p>Perbarui informasi penting seperti nomor WhatsApp, alamat, dan kata sandi. Halaman ini dirancang agar data tetap rapi dan mudah dikelola.</p>
            </div>

            <div class="status-badge">Aktif</div>
        </section>

        <div class="profile-grid">
            <aside class="profile-card profile-summary">
                <div class="profile-avatar">
                    <i class="fa-solid fa-user-tie"></i>
                </div>

                <div>
                    <h2>{{ $guru->nama_guru }}</h2>
                    <p>Guru mata pelajaran {{ $guru->mapel->nama_mapel ?? 'Umum' }}</p>
                </div>

                <div class="profile-metadata">
                    <div class="meta-item">
                        <label>Nomor WhatsApp</label>
                        <span>{{ $guru->no_whatsapp }}</span>
                    </div>

                    <div class="meta-item">
                        <label>Alamat</label>
                        <span>{{ $guru->alamat ?: 'Belum diisi' }}</span>
                    </div>

                    <div class="meta-item">
                        <label>Akun Terdaftar</label>
                        <span>{{ $guru->user->email ?? 'Email tidak tersedia' }}</span>
                    </div>
                </div>
            </aside>

            <div>
                <div class="profile-form-card">
                    <h2>Informasi Profil</h2>
                    <p>Gunakan tombol edit untuk memperbarui data guru. Setelah selesai, simpan perubahan agar informasi tersimpan dengan benar.</p>

                    @if(session('success'))
                        <div class="alert-box alert-success">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="/guru/profil">
                        @csrf

                        <div class="form-grid">
                            <div class="field-group">
                                <label for="nama_guru">Nama Guru</label>
                                <input type="text" id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}" readonly>
                            </div>

                            <div class="field-group">
                                <label for="no_whatsapp">No WhatsApp</label>
                                <input type="text" id="no_whatsapp" name="no_whatsapp" value="{{ $guru->no_whatsapp }}" readonly>
                            </div>
                        </div>

                        <div class="field-group">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" readonly>{{ $guru->alamat }}</textarea>
                        </div>

                        <div class="form-actions">
                            <div>
                                <button type="button" class="btn-warning" id="btnEdit">Edit Profil</button>
                                <button type="submit" class="btn-primary" id="btnSave" style="display:none;">Simpan Perubahan</button>
                            </div>

                            <button type="button" class="btn-secondary" onclick="openModal()">Ubah Password</button>
                        </div>
                    </form>
                </div>

                <div class="password-card">
                    <h2>Keamanan Akun</h2>
                    <p>Jika Anda ingin mengganti kata sandi, gunakan tombol di bawah untuk membuka dialog perubahan password yang aman.</p>
                    <button type="button" class="btn-primary" onclick="openModal()">Ubah Kata Sandi</button>
                </div>
            </div>
        </div>

        <div id="modalPassword" class="modal-backdrop">
            <div class="modal-card">
                <h3>Ubah Password</h3>
                <p>Masukkan password lama dan password baru untuk memperbarui kredensial akun Anda.</p>

                @if(session('error_password'))
                    <div class="alert-box alert-error">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ session('error_password') }}
                    </div>
                @endif

                @if(session('success_password'))
                    <div class="alert-box alert-success">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ session('success_password') }}
                    </div>
                @endif

                <form method="POST" action="/ubah-password">
                    @csrf
                    <div class="field-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" id="password_lama" name="password_lama" placeholder="Password Lama">
                    </div>

                    <div class="field-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" placeholder="Password Baru">
                    </div>

                    <div class="field-group">
                        <label for="password_baru_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" placeholder="Konfirmasi Password">
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                        <button type="submit" class="btn-primary">Simpan Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const btnEdit = document.getElementById('btnEdit');
        const btnSave = document.getElementById('btnSave');
        const inputs = document.querySelectorAll('input[id^="nama_guru"], input[id^="no_whatsapp"], textarea[id^="alamat"]');
        const modal = document.getElementById('modalPassword');

        btnEdit.addEventListener('click', () => {
            inputs.forEach(input => input.removeAttribute('readonly'));
            btnEdit.style.display = 'none';
            btnSave.style.display = 'inline-flex';
        });

        function openModal() {
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }
    </script>
@endsection