@extends('guru_user.layout')

@section('content')
<style>
    .topbar-actions {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .btn-primary {
        background: #ffc107;
        color: #073763;
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-primary:hover {
        background: #e0a800;
        transform: translateY(-2px);
    }
    .btn-danger {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.25s ease;
    }
    .btn-danger:hover {
        background: #c82333;
    }
    .btn-info {
        background: #17a2b8;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-info:hover {
        background: #138496;
    }
    .modal {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .modal.active { display: flex; }
    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 20px;
        width: 100%;
        max-width: 500px;
    }
    .form-group { margin-bottom: 20px; }
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #072d54;
    }
    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e9eff4;
        border-radius: 12px;
        font-family: inherit;
        font-size: 14px;
    }
    .alert {
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 600;
    }
    .alert-success { background: #d4edda; color: #155724; }
    .alert-danger { background: #f8d7da; color: #721c24; }
</style>

<div class="topbar">
    <div>
        <h1>Arsip Absensi</h1>
        <p>Kelola file absensi kelas secara manual</p>
    </div>
    <div class="topbar-actions">
        <button class="btn-primary" onclick="document.getElementById('uploadModal').classList.add('active')">
            <i class="fa-solid fa-plus"></i> Upload Baru
        </button>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Judul Arsip</th>
                    <th>Tanggal</th>
                    <th>Diunggah Oleh</th>
                    <th style="width: 250px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($arsip as $a)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $a->judul_arsip }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d F Y') }}</td>
                        <td>
                            @if($a->user)
                                <span style="background: #e9eff4; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: 600; color: #072d54;">
                                    {{ ucfirst($a->user->level) }}
                                </span>
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $extension = pathinfo($a->file_path, PATHINFO_EXTENSION);
                                $isPreviewable = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'pdf']);
                            @endphp
                            <div style="display: flex; gap: 8px;">
                                @if($isPreviewable)
                                    <button type="button" class="btn-info" onclick="openPreview('{{ Storage::url($a->file_path) }}', '{{ strtolower($extension) }}')">
                                        <i class="fa-solid fa-eye"></i> Preview
                                    </button>
                                @else
                                    <a href="{{ Storage::url($a->file_path) }}" target="_blank" class="btn-info" style="background: #28a745;">
                                        <i class="fa-solid fa-download"></i> Download
                                    </a>
                                @endif
                                <form action="/arsip-absensi/{{ $a->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty">Belum ada arsip absensi yang diunggah.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal" id="uploadModal">
    <div class="modal-content">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="margin: 0; color: #072d54;">Upload Arsip Absensi</h2>
            <button onclick="document.getElementById('uploadModal').classList.remove('active')" style="background:none; border:none; font-size:24px; cursor:pointer; color:#7a8596;">&times;</button>
        </div>
        
        <form action="/arsip-absensi/store" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Judul Arsip (Contoh: Absen Kelas 10 Matematika)</label>
                <input type="text" name="judul_arsip" class="form-control" required placeholder="Masukkan judul arsip">
            </div>
            <div class="form-group">
                <label>Tanggal Kelas</label>
                <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
                <label>File (Foto JPG/PNG atau Dokumen Excel/PDF)</label>
                <input type="file" name="file_arsip" class="form-control" required accept=".pdf,.xls,.xlsx,.jpg,.jpeg,.png">
                <small style="color: #6f7b8a; display: block; margin-top: 6px;">Maksimal ukuran file: 5MB</small>
            </div>
            <div style="margin-top: 30px; display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" class="btn-danger" style="background:#f1f5f9; color:#64748b;" onclick="document.getElementById('uploadModal').classList.remove('active')">Batal</button>
                <button type="submit" class="btn-primary" style="margin:0;">Simpan Arsip</button>
            </div>
        </form>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal" id="previewModal">
    <div class="modal-content" style="max-width: 800px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="margin: 0; color: #072d54;">Preview Arsip</h2>
            <button onclick="document.getElementById('previewModal').classList.remove('active')" style="background:none; border:none; font-size:24px; cursor:pointer; color:#7a8596;">&times;</button>
        </div>
        <div id="previewContainer" style="width: 100%; text-align: center; min-height: 200px; max-height: 70vh; overflow-y: auto;">
            <!-- Content -->
        </div>
        <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
            <a id="downloadBtn" href="#" target="_blank" class="btn-primary" style="text-decoration: none; padding: 8px 16px; font-size: 14px;">
                <i class="fa-solid fa-download"></i> Download File
            </a>
        </div>
    </div>
</div>

<script>
    function openPreview(url, type) {
        let container = document.getElementById('previewContainer');
        let downloadBtn = document.getElementById('downloadBtn');
        downloadBtn.href = url;

        if (['jpg', 'jpeg', 'png'].includes(type)) {
            container.innerHTML = `<img src="${url}" style="max-width: 100%; height: auto; border-radius: 8px;">`;
        } else if (type === 'pdf') {
            container.innerHTML = `<iframe src="${url}" style="width: 100%; height: 60vh; border: none; border-radius: 8px;"></iframe>`;
        }

        document.getElementById('previewModal').classList.add('active');
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('uploadModal')) {
            document.getElementById('uploadModal').classList.remove('active');
        }
        if (event.target == document.getElementById('previewModal')) {
            document.getElementById('previewModal').classList.remove('active');
        }
    }
</script>
@endsection
