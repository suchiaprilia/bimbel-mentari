@extends('layouts.admin_modern')
@php($editKelas = $editKelas ?? null)

@section('judul', 'Data Kelas')

@section('konten')

{{-- FORM --}}
<x-card title="{{ $editKelas ? 'Edit Kelas' : 'Tambah Kelas' }}" collapse="true" id="formKelas">

<form 
  action="{{ $editKelas ? route('kelas.update', $editKelas->id) : route('kelas.store') }}" 
  method="POST"
  class="form-crud"
  data-title="{{ $editKelas ? 'Ubah data kelas?' : 'Simpan data kelas?' }}"
  data-text="{{ $editKelas ? 'Data kelas akan diperbarui.' : 'Data kelas akan ditambahkan.' }}"
>
  @csrf
  @if($editKelas) @method('PUT') @endif

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>Nama Kelas</label>
        <input 
          type="text" 
          name="nama_kelas" 
          class="form-control @error('nama_kelas') is-invalid @enderror"
          value="{{ old('nama_kelas', $editKelas->nama_kelas ?? '') }}" 
          required
        >

        @error('nama_kelas')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
  </div>

  <div class="mt-2 text-right">
    <button type="submit" class="btn btn-success btn-sm">
      <i class="fas fa-save"></i> {{ $editKelas ? 'Update' : 'Simpan' }}
    </button>

    <a 
      href="{{ route('kelas.index', ['batal' => $editKelas ? 'edit' : 'tambah']) }}" 
      class="btn btn-secondary btn-sm btn-batal"
    >
      Batal
    </a>
  </div>

</form>

</x-card>


{{-- TABEL --}}
<x-card title="Data Kelas">

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Nama Kelas</th>
      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    @forelse($kelas as $row)
    <tr>

      <td>{{ $loop->iteration }}</td>
      <td>{{ $row->nama_kelas }}</td>

      <td class="text-center">
        <div class="dropdown">
          <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="{{ route('kelas.edit', $row->id) }}" class="dropdown-item">
              ✏ Edit
            </a>

            <form 
              action="{{ route('kelas.destroy', $row->id) }}" 
              method="POST"
              class="form-delete"
              data-nama="data kelas {{ $row->nama_kelas }}"
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
      <td colspan="3" class="text-center text-muted">
        Belum ada data kelas
      </td>
    </tr>
    @endforelse
  </tbody>

</table>
</div>

</x-card>

@endsection