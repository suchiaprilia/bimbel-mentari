@extends('layouts.admin_modern')

@section('judul', 'Data Pendaftaran')

@section('konten')

<x-card title="Data Pendaftaran">

@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

<div class="mb-3 d-flex justify-content-end">
  <form action="{{ route('pendaftaran.index') }}" method="GET" class="form-inline" style="gap: 5px;">
    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / no WA / kode..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari</button>
  </form>
</div>

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Nama Siswa</th>
      <th>Nama Ortu</th>
      <th>WhatsApp</th>
      <th>Jenjang</th>
      <th>Status</th>
      <th>Tanggal</th>
      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @forelse($pendaftarans as $item)
    <tr>
      <td>{{ $pendaftarans->firstItem() + $loop->index }}</td>
      <td>{{ $item->nama_siswa }}</td>
      <td>{{ $item->nama_ortu }}</td>
      <td>{{ $item->no_whatsapp }}</td>
      <td>{{ $item->jenjang }}</td>

      <td>
        <span class="badge
          {{ $item->status == 'Menunggu' ? 'badge-warning' :
             ($item->status == 'Diterima' ? 'badge-success' : 'badge-danger') }}">
          {{ $item->status }}
        </span>
      </td>

      <td>{{ $item->tanggal_daftar }}</td>

      <td class="text-center">
        <div class="dropdown">
          <button class="btn btn-light btn-sm" data-toggle="dropdown">⋮</button>

          <div class="dropdown-menu dropdown-menu-right">

            @if($item->status == 'Menunggu')

              {{-- TERIMA --}}
              <form action="{{ route('pendaftaran.simpanTerima', $item->id) }}"
                    method="POST" class="form-confirm"
                    data-title="Terima pendaftaran ini?"
                    data-text="Pendaftar akan dipindahkan ke Data Siswa."
                    data-icon="question"
                    data-color="#28a745"
                    data-btn="Ya, Terima">
                @csrf
                <button type="submit" class="dropdown-item text-success">
                  ✔ Terima
                </button>
              </form>

              {{-- TOLAK --}}
              <form action="{{ route('pendaftaran.tolak', $item->id) }}" method="POST"
                    class="form-confirm"
                    data-title="Tolak pendaftaran ini?"
                    data-text="Status pendaftaran akan diubah menjadi Ditolak."
                    data-icon="warning"
                    data-color="#dc3545"
                    data-btn="Ya, Tolak">
                @csrf
                @method('PUT')
                <button type="submit" class="dropdown-item text-danger">
                  ✖ Tolak
                </button>
              </form>

            @else
              <span class="dropdown-item text-muted">Sudah diproses</span>
            @endif

          </div>
        </div>
      </td>
    </tr>

    @empty
    <tr>
      <td colspan="8" class="text-center text-muted">
        Belum ada data pendaftaran
      </td>
    </tr>
    @endforelse

  </tbody>
</table>
</div>

<div class="mt-4">
  {{ $pendaftarans->withQueryString()->links() }}
</div>

</x-card>

@endsection