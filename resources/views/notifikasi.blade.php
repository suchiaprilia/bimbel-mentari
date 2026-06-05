@extends('layouts.admin_modern')

@section('judul', 'Riwayat Notifikasi WhatsApp')

@section('konten')

<div class="row">
    <div class="col-md-12">
        <x-card title="Daftar Notifikasi">
            
            <div class="d-flex justify-content-between mb-4 flex-wrap">
                {{-- SEARCH --}}
                <form action="{{ route('notifikasi.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari pesan atau nomor..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    @if(request('search'))
                        <a href="{{ route('notifikasi.index') }}" class="btn btn-secondary btn-sm">Reset</a>
                    @endif
                </form>

                {{-- CLEAR ALL --}}
                <form action="{{ route('notifikasi.clear') }}" method="POST" class="form-delete" data-nama="semua riwayat notifikasi">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash-can"></i> Hapus Semua Log
                    </button>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penerima</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th>Waktu Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifikasi as $n)
                        <tr>
                            <td>{{ ($notifikasi->currentPage() - 1) * $notifikasi->perPage() + $loop->iteration }}</td>
                            <td>
                                @if($n->pembayaran && $n->pembayaran->siswa)
                                    <span class="d-block font-weight-bold">{{ $n->pembayaran->siswa->nama_siswa }}</span>
                                @else
                                    <span class="d-block font-weight-bold text-muted">Siswa/Pendaftar</span>
                                @endif
                                <small class="text-muted">{{ $n->target_phone ?? '-' }}</small>
                                <br>
                                <span class="badge badge-light" style="font-size: 10px;">{{ strtoupper($n->type ?? 'umum') }}</span>
                            </td>
                            <td>
                                <div style="max-width: 400px; white-space: pre-wrap; font-size: 13px;">{{ $n->pesan }}</div>
                            </td>
                            <td>
                                @php
                                    $status = $n->status_kirim ?? 'Terkirim';
                                    $badgeClass = $status == 'Terkirim' ? 'badge-success' : 'badge-danger';
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted d-block">{{ \Carbon\Carbon::parse($n->waktu_kirim)->format('d M Y') }}</small>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($n->waktu_kirim)->format('H:i') }} WIB</small>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="fa-solid fa-bell-slash fa-3x mb-3 opacity-20"></i>
                                <p>Belum ada riwayat notifikasi terkirim.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $notifikasi->links() }}
            </div>

        </x-card>
    </div>
</div>

@endsection
