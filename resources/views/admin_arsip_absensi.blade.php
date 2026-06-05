@extends('layouts.admin_modern')

@section('judul', 'Arsip Absensi')

@section('konten')

<!-- Modals -->
<div class="modal fade" id="modalUploadArsip" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Arsip Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/arsip-absensi/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Judul Arsip <span class="text-danger">*</span></label>
                        <input type="text" name="judul_arsip" class="form-control" required placeholder="Contoh: Absensi Kelas 10 Mat 18 Mei">
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal Kelas <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>File Arsip (Max 5MB) <span class="text-danger">*</span></label>
                        <input type="file" name="file_arsip" class="form-control" required accept=".pdf,.xls,.xlsx,.jpg,.jpeg,.png">
                        <small class="form-text text-muted">Format didukung: PDF, Excel, JPG, PNG.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadArsip">
        <i class="fas fa-upload mr-1"></i> Upload Arsip Baru
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<x-card title="Daftar Arsip Absensi">
    <x-table>
        <x-slot name="thead">
            <th>No</th>
            <th>Judul Arsip</th>
            <th>Tanggal</th>
            <th>Waktu Upload</th>
            <th>Diunggah Oleh</th>
            <th width="150" class="text-center">Aksi</th>
        </x-slot>

        @forelse($arsip as $a)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td><strong>{{ $a->judul_arsip }}</strong></td>
            <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d F Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($a->created_at)->format('d M Y H:i') }}</td>
            <td>
                @if($a->user)
                    <span class="badge badge-secondary">{{ ucfirst($a->user->level) }}</span>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td class="text-center">
                @php
                    $extension = pathinfo($a->file_path, PATHINFO_EXTENSION);
                    $isPreviewable = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'pdf']);
                @endphp
                <div class="btn-group" role="group">
                    @if($isPreviewable)
                        <button type="button" class="btn btn-info btn-sm" title="Preview File" onclick="openPreviewAdmin('{{ Storage::url($a->file_path) }}', '{{ strtolower($extension) }}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    @else
                        <a href="{{ Storage::url($a->file_path) }}" target="_blank" class="btn btn-success btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
                    @endif
                    <form action="/arsip-absensi/{{ $a->id }}" method="POST" class="d-inline form-delete" data-nama="arsip absensi">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Arsip">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">Belum ada arsip absensi yang diunggah.</td>
        </tr>
        @endforelse
    </x-table>
</x-card>

<!-- Preview Modal Admin -->
<div class="modal fade" id="modalPreviewAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Arsip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="previewContainerAdmin" style="min-height: 200px; max-height: 70vh; overflow-y: auto;">
                <!-- Content injected via JS -->
            </div>
            <div class="modal-footer">
                <a id="downloadBtnAdmin" href="#" target="_blank" class="btn btn-primary">
                    <i class="fas fa-download mr-1"></i> Download File
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openPreviewAdmin(url, type) {
        let container = document.getElementById('previewContainerAdmin');
        let downloadBtn = document.getElementById('downloadBtnAdmin');
        downloadBtn.href = url;

        if (['jpg', 'jpeg', 'png'].includes(type)) {
            container.innerHTML = `<img src="${url}" class="img-fluid rounded" alt="Preview Gambar">`;
        } else if (type === 'pdf') {
            container.innerHTML = `<iframe src="${url}" style="width: 100%; height: 60vh; border: none; border-radius: 8px;"></iframe>`;
        }

        $('#modalPreviewAdmin').modal('show');
    }
</script>

@endsection
