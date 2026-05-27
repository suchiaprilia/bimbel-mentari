@extends('guru_user.layout')

@section('content')
    <style>
        .materi-page {
            display: grid;
            gap: 28px;
        }

        .materi-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .materi-header h1 {
            margin: 0;
            font-size: 32px;
            line-height: 1.1;
        }

        .materi-header p {
            margin: 8px 0 0;
            color: #6f7b8a;
            max-width: 720px;
        }

        .materi-panel {
            background: white;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 18px 40px rgba(7, 55, 99, 0.08);
        }

        .panel-title {
            margin: 0 0 18px;
            font-size: 22px;
            font-weight: 800;
            color: #072d54;
        }

        .panel-subtitle {
            margin: 0;
            color: #6f7b8a;
            line-height: 1.7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            font-weight: 700;
            color: #24314b;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #d8e0ea;
            border-radius: 16px;
            padding: 14px 16px;
            color: #072d54;
            background: #f8fafc;
            font-size: 14px;
            transition: border-color 0.2s ease;
        }

        .form-group textarea {
            min-height: 140px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #003b70;
            outline: none;
        }

        .btn-save-materi {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #003b70;
            color: white;
            border: none;
            border-radius: 16px;
            padding: 14px 24px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .btn-save-materi:hover {
            background: #064b86;
            transform: translateY(-1px);
        }

        .alert-box {
            border-radius: 18px;
            padding: 18px 22px;
            margin-bottom: 22px;
            font-weight: 700;
            display: inline-flex;
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

        .materi-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        .materi-table th,
        .materi-table td {
            padding: 16px 14px;
            border-bottom: 1px solid #e9eff4;
            text-align: left;
            vertical-align: middle;
        }

        .materi-table th {
            background: #f7fafc;
            color: #425069;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .materi-table tbody tr:hover {
            background: #f8fbff;
        }

        .table-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eef3ff;
            color: #073763;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .empty-state {
            padding: 30px;
            text-align: center;
            color: #7b8490;
            background: #f8fafc;
            border-radius: 18px;
        }

        .empty-state i {
            font-size: 36px;
            display: block;
            margin-bottom: 14px;
            color: #c4d4e0;
        }

        @media (max-width: 960px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .materi-table {
                min-width: 100%;
            }
        }

        @media (max-width: 680px) {
            .materi-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div class="materi-page">
        <div class="materi-header">
            <div>
                <h1>Materi Pembelajaran</h1>
                <p>Kelola materi siswa dengan tampilan yang lebih bersih dan profesional. Tambahkan materi baru dan pantau daftar materi dengan cepat.</p>
            </div>
            <div class="badge">{{ $materi->count() }} Materi</div>
        </div>

        @if(session('success'))
            <div class="alert-box alert-success">
                <i class="fa-solid fa-circle-check"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-box alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-box alert-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    <strong>Periksa kembali data yang dikirim:</strong>
                    <ul style="margin: 10px 0 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="materi-panel">
            <h2 class="panel-title">Tambah Materi Baru</h2>
            <p class="panel-subtitle">Isi informasi materi untuk kelas dan mata pelajaran yang tepat, lalu unggah file pendukung.</p>

            <form action="/guru/materi/store" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="judul_materi">Judul Materi</label>
                        <input type="text" id="judul_materi" name="judul_materi" required placeholder="Masukkan judul materi" value="{{ old('judul_materi') }}">
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">Kelas</label>
                        <select id="id_kelas" name="id_kelas" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('id_kelas') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_mapel">Mata Pelajaran</label>
                        <select id="id_mapel" name="id_mapel" required>
                            <option value="">Pilih Mapel</option>
                            @foreach($mapel as $m)
                                <option value="{{ $m->id_mapel }}" {{ old('id_mapel') == $m->id_mapel ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="file_materi">File Materi</label>
                        <input type="file" id="file_materi" name="file_materi" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" placeholder="Tambahkan deskripsi singkat materi">{{ old('deskripsi') }}</textarea>
                </div>

                <button type="submit" class="btn-save-materi">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    Simpan Materi
                </button>
            </form>
        </div>

        <div class="materi-panel">
            <h2 class="panel-title">Daftar Materi</h2>
            <p class="panel-subtitle">Lihat materi yang sudah diunggah untuk setiap kelas dan mata pelajaran.</p>

            <div class="table-responsive">
                <table class="materi-table">
                    <thead>
                        <tr>
                            <th>Judul Materi</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>File</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($materi as $m)
                            <tr>
                                <td>{{ $m->judul_materi }}</td>
                                <td>{{ $m->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $m->mapel->nama_mapel ?? '-' }}</td>
                                <td>
                                    @if($m->file_materi)
                                        <span class="table-label"><i class="fa-solid fa-file-arrow-down"></i> Ada File</span>
                                    @else
                                        <span class="table-label" style="background:#f8d7da; color:#842029;">Tidak Ada File</span>
                                    @endif
                                </td>
                                <td>{{ $m->tanggal_upload ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-folder-open"></i>
                                        Belum ada materi yang tersedia. Tambahkan materi baru agar siswa dapat mengaksesnya.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
