@extends('layouts.admin_modern')
@php($editGuru = $editGuru ?? null)

@section('judul', 'Data Guru')

@section('konten')

<x-card title="{{ $editGuru ? 'Edit Guru' : 'Tambah Guru' }}" collapse="true" id="formGuru">

<form 
  action="{{ $editGuru ? route('guru.update', $editGuru->id) : route('guru.store') }}" 
  method="POST"
  class="form-crud"
  data-title="{{ $editGuru ? 'Ubah data guru?' : 'Simpan data guru?' }}"
  data-text="{{ $editGuru ? 'Data guru akan diperbarui.' : 'Data guru akan ditambahkan.' }}"
>

  @csrf

  @if($editGuru)
    @method('PUT')
  @endif

  <div class="row">

    {{-- NAMA GURU --}}
    <div class="col-md-6">
      <div class="form-group">

        <label>Nama Guru</label>

        <input 
          type="text"
          name="nama_guru"
          class="form-control @error('nama_guru') is-invalid @enderror"
          value="{{ old('nama_guru', $editGuru->nama_guru ?? '') }}"
          required
        >

        @error('nama_guru')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>


    {{-- MAPEL --}}
    <div class="col-md-6">
      <div class="form-group">

        <label>Mata Pelajaran</label>

        <select 
          name="id_mapel"
          class="form-control @error('id_mapel') is-invalid @enderror"
          required
        >

          <option value="">-- Pilih Mapel --</option>

          @foreach($mapel as $m)

            <option value="{{ $m->id_mapel }}"
              {{ old('id_mapel', $editGuru->id_mapel ?? '') == $m->id_mapel ? 'selected' : '' }}>

              {{ $m->nama_mapel }}

            </option>

          @endforeach

        </select>

        @error('id_mapel')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>


    {{-- WHATSAPP --}}
    <div class="col-md-6">
      <div class="form-group">

        <label>No WhatsApp</label>

        <input 
          type="text"
          name="no_whatsapp"
          class="form-control @error('no_whatsapp') is-invalid @enderror"
          value="{{ old('no_whatsapp', $editGuru->no_whatsapp ?? '') }}"
          required
        >

        @error('no_whatsapp')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>


    {{-- ALAMAT --}}
    <div class="col-md-12">
      <div class="form-group">

        <label>Alamat</label>

        <textarea 
          name="alamat"
          rows="3"
          class="form-control @error('alamat') is-invalid @enderror"
        >{{ old('alamat', $editGuru->alamat ?? '') }}</textarea>

        @error('alamat')
          <small class="text-danger">{{ $message }}</small>
        @enderror

      </div>
    </div>

  </div>


  <div class="mt-2 text-right">

    <button type="submit" class="btn btn-success btn-sm">
      {{ $editGuru ? 'Update' : 'Simpan' }}
    </button>

    <a 
      href="{{ route('guru.index') }}"
      class="btn btn-secondary btn-sm"
    >
      Batal
    </a>

  </div>

</form>

</x-card>



<x-card title="Data Guru">

<div class="table-responsive">

<table class="table table-bordered table-hover">

  <thead class="bg-light">

    <tr>

      <th>No</th>
      <th>Nama Guru</th>
      <th>Mapel</th>
      <th>No WhatsApp</th>
      <th>Alamat</th>
      <th width="80">Aksi</th>

    </tr>

  </thead>

  <tbody>

    @forelse($guru as $row)

    <tr>

      <td>{{ $loop->iteration }}</td>

      <td>{{ $row->nama_guru }}</td>

      <td>
        {{ $row->mapel->nama_mapel ?? '-' }}
      </td>

      <td>{{ $row->no_whatsapp }}</td>

      <td>{{ $row->alamat ?? '-' }}</td>

      <td class="text-center">

        <div class="dropdown">

          <button type="button"
                  class="btn btn-light btn-sm"
                  data-toggle="dropdown">

            ⋮

          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="{{ route('guru.edit', $row->id) }}"
               class="dropdown-item">

              ✏ Edit

            </a>

            <form 
              action="{{ route('guru.destroy', $row->id) }}"
              method="POST"
              class="form-delete"
              data-nama="data guru {{ $row->nama_guru }}"
            >

              @csrf
              @method('DELETE')

              <button type="submit"
                      class="dropdown-item text-danger">

                🗑 Hapus

              </button>

            </form>

          </div>

        </div>

      </td>

    </tr>

    @empty

    <tr>

      <td colspan="6" class="text-center text-muted">
        Belum ada data guru
      </td>

    </tr>

    @endforelse

  </tbody>

</table>

</div>

</x-card>

@endsection