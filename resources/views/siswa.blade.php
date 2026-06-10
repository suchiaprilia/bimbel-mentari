@extends('layouts.admin_modern')
@php($editSiswa = $editSiswa ?? null)

@section('judul', 'Data Siswa')

@section('konten')

{{-- FORM --}}
<x-card title="{{ $editSiswa ? 'Edit Siswa' : 'Tambah Siswa' }}" collapse="true" :show="$editSiswa ? true : false" id="formSiswa">

<form 
  action="{{ $editSiswa ? route('siswa.update', $editSiswa->id) : route('siswa.store') }}" 
  method="POST"
  class="form-crud"
  data-title="{{ $editSiswa ? 'Ubah data siswa?' : 'Simpan data siswa?' }}"
  data-text="{{ $editSiswa ? 'Data siswa akan diperbarui.' : 'Data siswa akan ditambahkan.' }}"
>
  @csrf
  @if($editSiswa) @method('PUT') @endif

  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror" required>
          <option value="">-- Pilih Kelas --</option>
          @foreach($kelas as $k)
            <option value="{{ $k->id }}"
              {{ old('id_kelas', $editSiswa->id_kelas ?? '') == $k->id ? 'selected' : '' }}>
              {{ $k->nama_kelas }}
            </option>
          @endforeach
        </select>

        @error('id_kelas')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label>Nama Siswa</label>
        <input 
          type="text" 
          name="nama_siswa" 
          class="form-control @error('nama_siswa') is-invalid @enderror"
          value="{{ old('nama_siswa', $editSiswa->nama_siswa ?? '') }}" 
          required
        >

        @error('nama_siswa')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label>No WhatsApp</label>
        <input 
          type="text" 
          name="no_whatsapp" 
          class="form-control @error('no_whatsapp') is-invalid @enderror"
          value="{{ old('no_whatsapp', $editSiswa->no_whatsapp ?? '') }}" 
          required
        >

        @error('no_whatsapp')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-md-8">
      <div class="form-group">
        <label>Alamat</label>
        <textarea 
          name="alamat" 
          class="form-control @error('alamat') is-invalid @enderror" 
          rows="2"
        >{{ old('alamat', $editSiswa->alamat ?? '') }}</textarea>

        @error('alamat')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
          <option value="aktif" {{ old('status', $editSiswa->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>
            Aktif
          </option>
          <option value="nonaktif" {{ old('status', $editSiswa->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
            Nonaktif
          </option>
        </select>

        @error('status')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

  </div>

  <div class="mt-2 text-right">
    <button type="submit" class="btn btn-success btn-sm">
      {{ $editSiswa ? 'Update' : 'Simpan' }}
    </button>

    <a 
      href="{{ route('siswa.index', ['batal' => $editSiswa ? 'edit' : 'tambah']) }}" 
      class="btn btn-secondary btn-sm btn-batal"
    >
      Batal
    </a>
  </div>

</form>

</x-card>


{{-- TABEL --}}
<x-card title="Data Lengkap Siswa">

<div class="mb-3 d-flex justify-content-end">
  <form action="{{ route('siswa.index') }}" method="GET" class="form-inline d-flex flex-wrap" style="gap: 10px; max-width: 100%;">
    
    <select name="kelas" class="form-control form-control-sm" style="min-width: 130px; padding: 0.25rem 0.5rem; height: auto;">
      <option value="">-- Semua Kelas --</option>
      @foreach($kelas as $k)
        <option value="{{ $k->id }}" {{ request('kelas') == $k->id ? 'selected' : '' }}>
          Kelas {{ $k->nama_kelas }}
        </option>
      @endforeach
    </select>

    <select name="mapel" class="form-control form-control-sm" style="min-width: 150px; padding: 0.25rem 0.5rem; height: auto;">
      <option value="">-- Semua Mapel --</option>
      @if(isset($mapel))
        @foreach($mapel as $m)
          <option value="{{ $m->id }}" {{ request('mapel') == $m->id ? 'selected' : '' }}>
            {{ $m->nama_mapel }}
          </option>
        @endforeach
      @endif
    </select>

    <select name="status" class="form-control form-control-sm" style="min-width: 130px; padding: 0.25rem 0.5rem; height: auto;">
      <option value="">-- Semua Status --</option>
      <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
      <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>

    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama / no WA..." value="{{ request('search') }}" style="min-width: 200px;">
    
    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Cari</button>
  </form>
</div>

<x-table>

<x-slot name="thead">
  <th>No</th>

  <th>Kelas</th>
  <th>Nama</th>
  <th>Mapel Diikuti</th>
  <th>Alamat</th>
  <th>WhatsApp</th>
  <th>Status</th>
  <th width="80">Aksi</th>
</x-slot>

@forelse($siswa as $row)
<tr>

  <td>{{ $siswa->firstItem() + $loop->index }}</td>


  <td>
    {{ $row->kelas->nama_kelas ?? '-' }}
  </td>

  <td>
    {{ $row->nama_siswa }}
  </td>

  <td>
    @forelse($row->mapels as $m)

      <span class="badge badge-info">
        {{ $m->nama_mapel }}
      </span>

    @empty

      <span class="text-muted">
        Tidak ada mapel
      </span>

    @endforelse
  </td>

  <td>
    {{ $row->alamat ?? '-' }}
  </td>

  <td>
    {{ $row->no_whatsapp }}
  </td>

  {{-- STATUS --}}
  <td>
    @php($status = strtolower($row->status))

    <span class="badge {{ $status == 'aktif' ? 'badge-success' : 'badge-danger' }}">
      {{ $status == 'aktif' ? 'Aktif' : 'Nonaktif' }}
    </span>
  </td>

  {{-- DROPDOWN AKSI --}}
  <td class="text-center">
    <div class="dropdown">
      <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
        ⋮
      </button>

      <div class="dropdown-menu dropdown-menu-right">

        <a href="{{ route('siswa.edit', $row->id) }}" class="dropdown-item">
          ✏ Edit
        </a>

        <form action="{{ route('siswa.resetPassword', $row->id) }}" method="POST"
              class="form-confirm"
              data-title="Reset Password?"
              data-text="Password siswa ini akan diubah menjadi 12345678."
              data-icon="warning"
              data-color="#ffc107"
              data-btn="Ya, Reset">
          @csrf
          <button type="submit" class="dropdown-item text-warning">
            🔑 Reset Password
          </button>
        </form>

        <form 
          action="{{ route('siswa.destroy', $row->id) }}" 
          method="POST"
          class="form-delete"
          data-nama="data siswa {{ $row->nama_siswa }}"
        >
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

@empty
<tr>
  <td colspan="9" class="text-center text-muted">
    Belum ada data siswa
  </td>
</tr>
@endforelse

</x-table>

<div class="mt-4">
  {{ $siswa->withQueryString()->links() }}
</div>

</x-card>

@endsection