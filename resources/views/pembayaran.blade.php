@extends('layouts.admin_modern')
@php($editPembayaran = $editPembayaran ?? null)

@section('judul', 'Data Pembayaran')

@section('konten')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="mb-3 d-flex justify-content-between align-items-center">
  {{-- ====================================================
       [UI-CONFIG] KOMPONEN TOMBOL PENGINGAT MANUAL
       Trigger untuk menjalankan command reminder melalui HTTP request.
  ==================================================== --}}
  <form action="{{ route('pembayaran.reminder') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-warning btn-sm">
      Kirim Pengingat Pembayaran WA
    </button>
  </form>

  {{-- ====================================================
       [UI-CONFIG] KOMPONEN TOMBOL TAMBAH DATA (CREATE)
       Navigasi untuk membuat entri tagihan baru.
  ==================================================== --}}
  <a href="{{ route('tagihan.index') }}" class="btn btn-info btn-sm">
    <i class="fas fa-plus-circle"></i> Buat Tagihan Baru
  </a>
</div>

{{-- TABEL --}}
<x-card title="Data Pembayaran">

<div class="mb-3 d-flex justify-content-end">
  <form action="{{ route('pembayaran.index') }}" method="GET" class="form-inline" style="gap: 5px;">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari siswa / status..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari</button>
  </form>
</div>

<div class="table-responsive">
{{-- ====================================================
     [UI-CONFIG] STRUKTUR TABEL DATA PEMBAYARAN
     Pengaturan header (th) dan iterasi baris (td) untuk data transaksi.
==================================================== --}}
<table class="table table-hover align-middle">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Siswa</th>
      <th>Jumlah</th>
      <th>Metode</th>
      <th>Status</th>
      <th>Jatuh Tempo</th>
      <th>Bukti</th>
      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach($pembayaran as $row)
    <tr>

      <td>{{ $pembayaran->firstItem() + $loop->index }}</td>
      <td>{{ $row->siswa->nama_siswa ?? '-' }}</td>
      <td>Rp {{ number_format($row->jumlah,0,',','.') }}</td>
      <td>{{ ucfirst($row->metode_pembayaran) }}</td>

      {{-- ====================================================
           [UI-CONFIG] KOMPONEN BADGE STATUS
           Pewarnaan dinamis berdasarkan enum status pembayaran.
      ==================================================== --}}
      <td>
        <span class="badge 
          {{ $row->status == 'Lunas' ? 'badge-success' : 
             ($row->status == 'Menunggu' ? 'badge-warning' : 'badge-danger') }}">
          {{ $row->status }}
        </span>
      </td>

      <td>{{ $row->tanggal_jatuh_tempo }}</td>

      <td>
        @if($row->bukti_transfer)
          <a href="{{ asset('storage/'.$row->bukti_transfer) }}" target="_blank" class="btn btn-info btn-sm">
            Lihat
          </a>
        @else
          -
        @endif
      </td>

      {{-- 🔥 DROPDOWN 3 TITIK --}}
      <td class="text-center">
        <div class="dropdown">
          <button class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            @if($row->status == 'Menunggu')
              <form action="{{ route('pembayaran.verifikasi', $row->id) }}" method="POST">
                @csrf
                <button class="dropdown-item text-success">✔ Verifikasi</button>
              </form>
            @endif

            @if($row->status != 'Lunas')
              <form action="{{ route('pembayaran.bayarTunai', $row->id) }}" method="POST">
                @csrf
                <button class="dropdown-item text-primary">💵 Bayar Tunai</button>
              </form>
            @endif

            <a href="{{ route('tagihan.edit', $row->id) }}" 
               class="dropdown-item">✏ Edit Tagihan</a>

            <form action="{{ route('tagihan.destroy', $row->id) }}" method="POST" class="form-delete" data-nama="data ini">
              @csrf
              @method('DELETE')
              <button type="submit" class="dropdown-item text-danger">
                🗑 Hapus
              </button>
            </form>

          </div>
        </div>
      </td>

    </tr>
    @endforeach
  </tbody>
</table>
</div>

<div class="mt-4">
  {{ $pembayaran->withQueryString()->links() }}
</div>

</x-card>

@endsection