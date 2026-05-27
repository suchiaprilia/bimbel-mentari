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
  <form action="{{ route('pembayaran.reminder') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-warning btn-sm">
      Kirim Pengingat Pembayaran WA
    </button>
  </form>
  <a href="{{ route('tagihan.index') }}" class="btn btn-info btn-sm">
    <i class="fas fa-plus-circle"></i> Buat Tagihan Baru
  </a>
</div>

{{-- TABEL --}}
<x-card title="Data Pembayaran">

<div class="table-responsive">
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

      <td>{{ $loop->iteration }}</td>
      <td>{{ $row->siswa->nama_siswa ?? '-' }}</td>
      <td>Rp {{ number_format($row->jumlah,0,',','.') }}</td>
      <td>{{ ucfirst($row->metode_pembayaran) }}</td>

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

            <form action="{{ route('tagihan.destroy', $row->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="dropdown-item text-danger" onclick="return confirm('Hapus data?')">
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

</x-card>

@endsection