@extends('layouts.admin_modern')
@php($editMateri = $editMateri ?? null)

@section('judul', 'Data Materi')

@section('konten')

<x-card title="{{ $editMateri ? 'Edit Materi' : 'Tambah Materi' }}" collapse="true" id="formMateri">

<form 
  action="{{ $editMateri ? route('materi.update', $editMateri->id) : route('materi.store') }}"
  method="POST" 
  enctype="multipart/form-data"
  class="form-crud"
  data-title="{{ $editMateri ? 'Ubah data materi?' : 'Simpan data materi?' }}"
  data-text="{{ $editMateri ? 'Data materi akan diperbarui.' : 'Data materi akan ditambahkan.' }}"
>
  @csrf
  @if($editMateri) @method('PUT') @endif

  <div class="row">

    {{-- GURU --}}
    <div class="col-md-3">
      <div class="form-group">

        <label>Guru</label>

        <select 
          name="id_guru" 
          id="id_guru"
          class="form-control @error('id_guru') is-invalid @enderror" 
          required
        >

          <option value="">-- Pilih Guru --</option>

          @foreach($guru as $g)

            <option 
              value="{{ $g->id }}"
              data-mapel="{{ $g->mapel->nama_mapel ?? '-' }}"
              {{ old('id_guru', $editMateri->id_guru ?? '') == $g->id ? 'selected' : '' }}
            >

              {{ $g->nama_guru }}

            </option>

          @endforeach

        </select>

        @error('id_guru')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>

    {{-- MAPEL OTOMATIS --}}
    <div class="col-md-3">
      <div class="form-group">

        <label>Mata Pelajaran</label>

        <input 
          type="text"
          id="nama_mapel"
          class="form-control"
          readonly
          value="{{ $editMateri->guru->mapel->nama_mapel ?? '' }}"
        >

      </div>
    </div>

    {{-- KELAS --}}
    <div class="col-md-3">
      <div class="form-group">
        <label>Kelas</label>

        <select 
          name="id_kelas" 
          class="form-control @error('id_kelas') is-invalid @enderror" 
          required
        >

          <option value="">-- Pilih Kelas --</option>

          @foreach($kelas as $k)

            <option value="{{ $k->id }}"
              {{ old('id_kelas', $editMateri->id_kelas ?? '') == $k->id ? 'selected' : '' }}>

              {{ $k->nama_kelas }}

            </option>

          @endforeach

        </select>

        @error('id_kelas')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>

    {{-- TANGGAL --}}
    <div class="col-md-3">
      <div class="form-group">

        <label>Tanggal Upload</label>

        <input 
          type="date" 
          name="tanggal_upload" 
          class="form-control @error('tanggal_upload') is-invalid @enderror"
          value="{{ old('tanggal_upload', $editMateri->tanggal_upload ?? date('Y-m-d')) }}" 
          required
        >

        @error('tanggal_upload')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>

    {{-- JUDUL --}}
    <div class="col-md-6">
      <div class="form-group">

        <label>Judul Materi</label>

        <input 
          type="text" 
          name="judul_materi" 
          class="form-control @error('judul_materi') is-invalid @enderror"
          value="{{ old('judul_materi', $editMateri->judul_materi ?? '') }}" 
          required
        >

        @error('judul_materi')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>

    {{-- FILE --}}
    <div class="col-md-6">
      <div class="form-group">

        <label>File Materi</label>

        <input 
          type="file" 
          name="file_materi" 
          class="form-control @error('file_materi') is-invalid @enderror"
        >

        @if($editMateri && $editMateri->file_materi)

          <small class="text-muted">
            File lama: <b>{{ basename($editMateri->file_materi) }}</b>
          </small>

        @endif

        @error('file_materi')
          <small class="text-danger d-block">{{ $message }}</small>
        @enderror

      </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="col-md-12">
      <div class="form-group">

        <label>Deskripsi</label>

        <textarea 
          name="deskripsi" 
          class="form-control @error('deskripsi') is-invalid @enderror" 
          rows="3"
        >{{ old('deskripsi', $editMateri->deskripsi ?? '') }}</textarea>

        @error('deskripsi')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>

  </div>

  <div class="mt-2 text-right">

    <button type="submit" class="btn btn-success btn-sm">
      <i class="fas fa-save"></i> {{ $editMateri ? 'Update' : 'Simpan' }}
    </button>

    <a 
      href="{{ route('materi.index', ['batal' => $editMateri ? 'edit' : 'tambah']) }}" 
      class="btn btn-secondary btn-sm btn-batal"
    >
      Batal
    </a>

  </div>

</form>

</x-card>

<x-card title="Data Materi">

<div class="table-responsive">

<table class="table table-bordered table-hover">

  <thead class="bg-light">

    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Judul</th>
      <th>Kelas</th>
      <th>Mapel</th>
      <th>Guru</th>
      <th>File</th>
      <th width="80">Aksi</th>
    </tr>

  </thead>

  <tbody>

    @forelse($materi as $row)

    <tr>

      <td>{{ $loop->iteration }}</td>

      <td>{{ $row->tanggal_upload }}</td>

      <td>{{ $row->judul_materi }}</td>

      <td>{{ $row->kelas->nama_kelas ?? '-' }}</td>

      <td>{{ $row->guru->mapel->nama_mapel ?? '-' }}</td>

      <td>{{ $row->guru->nama_guru ?? '-' }}</td>

      <td>

        @if($row->file_materi)

          <a href="{{ route('materi.download', $row->id) }}" class="btn btn-info btn-sm">
            ⬇
          </a>

        @else
          -
        @endif

      </td>

      <td class="text-center">

        <div class="dropdown">

          <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="{{ route('materi.edit', $row->id) }}" class="dropdown-item">
              ✏ Edit
            </a>

            @if($row->file_materi)

              <a href="{{ route('materi.download', $row->id) }}" class="dropdown-item">
                ⬇ Download
              </a>

            @endif

            <form 
              action="{{ route('materi.destroy', $row->id) }}" 
              method="POST"
              class="form-delete"
              data-nama="materi {{ $row->judul_materi }}"
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

      <td colspan="8" class="text-center text-muted">
        Belum ada data materi
      </td>

    </tr>

    @endforelse

  </tbody>

</table>

</div>

</x-card>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const guru = document.getElementById('id_guru');
    const mapel = document.getElementById('nama_mapel');

    function tampilMapel() {

        const selected = guru.options[guru.selectedIndex];

        mapel.value = selected.getAttribute('data-mapel') || '';

    }

    guru.addEventListener('change', tampilMapel);

    tampilMapel();

});

</script>

@endsection