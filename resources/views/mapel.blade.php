@extends('layouts.admin_modern')
@php($editMapel = $editMapel ?? null)

@section('judul', 'Data Mata Pelajaran')

@section('konten')

{{-- FORM --}}
<x-card title="{{ $editMapel ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' }}" collapse="true" id="formMapel">

<form 
  action="{{ $editMapel ? route('mapel.update', $editMapel->id_mapel) : route('mapel.store') }}" 
  method="POST"
  class="form-crud"
  data-title="{{ $editMapel ? 'Ubah data mata pelajaran?' : 'Simpan data mata pelajaran?' }}"
  data-text="{{ $editMapel ? 'Data mata pelajaran akan diperbarui.' : 'Data mata pelajaran akan ditambahkan.' }}"
>
  @csrf
  @if($editMapel) @method('PUT') @endif

  <div class="row">

    <div class="col-md-8">
      <div class="form-group">
        <label>Nama Mata Pelajaran</label>
        <input 
          type="text" 
          name="nama_mapel" 
          class="form-control @error('nama_mapel') is-invalid @enderror"
          value="{{ old('nama_mapel', $editMapel->nama_mapel ?? '') }}" 
          required
        >
        @error('nama_mapel')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

  </div>

  <div class="mt-2 text-right">
    <button type="submit" class="btn btn-success btn-sm">
      <i class="fas fa-save"></i> {{ $editMapel ? 'Update' : 'Simpan' }}
    </button>

    <a 
      href="{{ route('mapel.index', ['batal' => $editMapel ? 'edit' : 'tambah']) }}" 
      class="btn btn-secondary btn-sm btn-batal"
    >
      Batal
    </a>
  </div>

</form>

</x-card>


{{-- TABEL --}}
<x-card title="Data Mata Pelajaran">

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Nama Mapel</th>

      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @forelse($mapel as $row)
    <tr>

      <td>{{ $loop->iteration }}</td>
      <td>{{ $row->nama_mapel }}</td>


      <td class="text-center">
        <div class="dropdown">
          <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="{{ route('mapel.edit', $row->id_mapel) }}" class="dropdown-item">
              ✏ Edit
            </a>

            <form 
              action="{{ route('mapel.destroy', $row->id_mapel) }}" 
              method="POST"
              class="form-delete"
              data-nama="mata pelajaran {{ $row->nama_mapel }}"
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
      <td colspan="4" class="text-center text-muted">
        Belum ada data mata pelajaran
      </td>
    </tr>
    @endforelse
  </tbody>

</table>
</div>

</x-card>

@endsection