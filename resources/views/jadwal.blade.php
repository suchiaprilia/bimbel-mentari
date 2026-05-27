@extends('layouts.admin_modern')
@php($editJadwal = $editJadwal ?? null)

@section('judul', 'Data Jadwal')

@section('konten')

{{-- BOOTSTRAP SELECT --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<style>
.bootstrap-select .dropdown-menu { max-height: 300px !important; }
.bootstrap-select .dropdown-item { padding: 8px 15px; }
</style>

{{-- FORM --}}
<x-card title="{{ $editJadwal ? 'Edit Jadwal' : 'Tambah Jadwal' }}" collapse="true" id="formJadwal">

<form 
    action="{{ $editJadwal ? route('jadwal.update', $editJadwal->id_jadwal) : route('jadwal.store') }}" 
    method="POST"
    class="form-crud"
>

    @csrf

    @if($editJadwal)
        @method('PUT')
    @endif

    <div class="row">

        {{-- GURU --}}
        <div class="col-md-4">
            <div class="form-group">

                <label>Guru</label>

                <select 
                    name="id_guru"
                    id="id_guru"
                    class="form-control"
                    required
                >

                    <option value="">-- Pilih Guru --</option>

                    @foreach($guru as $g)

                        <option 
                            value="{{ $g->id }}"
                            data-mapel-id="{{ $g->id_mapel }}"
                            data-mapel="{{ $g->mapel->nama_mapel ?? '-' }}"
                            {{ old('id_guru', $editJadwal->id_guru ?? '') == $g->id ? 'selected' : '' }}
                        >

                            {{ $g->nama_guru }}

                        </option>

                    @endforeach

                </select>

            </div>
        </div>


        {{-- KELAS --}}
        <div class="col-md-4">
            <div class="form-group">

                <label>Kelas</label>

                <select 
                    name="id_kelas"
                    id="id_kelas"
                    class="form-control"
                    required
                >

                    <option value="">-- Pilih Kelas --</option>

                    @foreach($kelas as $k)

                        <option 
                            value="{{ $k->id }}"
                            {{ old('id_kelas', $editJadwal->id_kelas ?? '') == $k->id ? 'selected' : '' }}
                        >

                            {{ $k->nama_kelas }}

                        </option>

                    @endforeach

                </select>

            </div>
        </div>


        {{-- MAPEL --}}
        <div class="col-md-4">
            <div class="form-group">

                <label>Mata Pelajaran</label>

                <input 
                    type="text"
                    id="nama_mapel"
                    class="form-control"
                    readonly
                    value="{{ $editJadwal->mapel->nama_mapel ?? '' }}"
                >

                {{-- ID MAPEL TERKIRIM KE DB --}}
                <input 
                    type="hidden"
                    name="id_mapel"
                    id="id_mapel"
                    value="{{ old('id_mapel', $editJadwal->id_mapel ?? '') }}"
                >

            </div>
        </div>


        {{-- PILIH SISWA --}}
        <div class="col-md-12">

            <div class="form-group">

                <label>Pilih Siswa</label>

                <select 
                    name="siswa_id[]"
                    id="siswaDropdown"
                    class="form-control selectpicker"
                    data-live-search="true"
                    data-actions-box="true"
                    data-container="body"
                    title="-- Pilih Siswa --"
                    data-selected-text-format="count > 2"
                    multiple
                    required
                >

                    @foreach($siswa as $s)

                        <option 
                            value="{{ $s->id }}"
                            data-kelas="{{ $s->id_kelas }}"
                            data-mapel="{{ $s->mapels->pluck('id_mapel')->implode(',') }}"

                            @if($editJadwal)

                                {{ in_array(
                                    $s->id,
                                    $editJadwal->siswa->pluck('id')->toArray()
                                ) ? 'selected' : '' }}

                            @endif
                        >

                            {{ $s->nama_siswa }}

                        </option>

                    @endforeach

                </select>

                <small class="text-muted">
                    Siswa otomatis tampil sesuai kelas dan mapel
                </small>

            </div>

        </div>


        {{-- TANGGAL --}}
        <div class="col-md-4">
            <div class="form-group">

                <label>Tanggal</label>

                <input 
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ old('tanggal', $editJadwal->tanggal ?? '') }}"
                    required
                >

            </div>
        </div>


        {{-- JAM MULAI --}}
        <div class="col-md-4">
            <div class="form-group">

                <label>Jam Mulai</label>

                <input 
                    type="time"
                    name="jam_mulai"
                    class="form-control"
                    value="{{ old('jam_mulai', $editJadwal->jam_mulai ?? '') }}"
                    required
                >

            </div>
        </div>


        {{-- JAM SELESAI --}}
        <div class="col-md-4">
            <div class="form-group">

                <label>Jam Selesai</label>

                <input 
                    type="time"
                    name="jam_selesai"
                    class="form-control"
                    value="{{ old('jam_selesai', $editJadwal->jam_selesai ?? '') }}"
                    required
                >

            </div>
        </div>

    </div>


    <div class="mt-3 text-right">

        <button type="submit" class="btn btn-success btn-sm">
            {{ $editJadwal ? 'Update' : 'Simpan' }}
        </button>

        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-sm">
            Batal
        </a>

    </div>

</form>

</x-card>



{{-- TABEL --}}
<x-card title="Data Jadwal">

<div class="table-responsive">

<table class="table table-bordered table-hover">

    <thead class="bg-light">

        <tr>

            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Kelas</th>
            <th>Mapel</th>
            <th>Guru</th>
            <th>Siswa</th>
            <th width="80">Aksi</th>

        </tr>

    </thead>

    <tbody>

        @forelse($jadwal as $row)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $row->tanggal }}</td>

            <td>
                {{ $row->jam_mulai }} - {{ $row->jam_selesai }}
            </td>

            <td>
                {{ $row->kelas->nama_kelas ?? '-' }}
            </td>

            <td>
                {{ $row->mapel->nama_mapel ?? '-' }}
            </td>

            <td>
                {{ $row->guru->nama_guru ?? '-' }}
            </td>

            <td>

                @forelse($row->siswa as $s)

                    <span class="badge badge-info">
                        {{ $s->nama_siswa }}
                    </span>
                    <br>

                @empty

                    <span class="text-muted">
                        Tidak ada siswa
                    </span>

                @endforelse

            </td>

            <td class="text-center">

                <div class="dropdown">

                    <button type="button"
                            class="btn btn-light btn-sm"
                            data-toggle="dropdown">

                        ⋮

                    </button>

                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="{{ route('jadwal.edit', $row->id_jadwal) }}"
                           class="dropdown-item">

                            ✏ Edit

                        </a>

                        <form 
                            action="{{ route('jadwal.destroy', $row->id_jadwal) }}"
                            method="POST"
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

            <td colspan="8" class="text-center text-muted">
                Belum ada data jadwal
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
    const namaMapel = document.getElementById('nama_mapel');
    const idMapel = document.getElementById('id_mapel');

    function tampilMapel() {

        const selected = guru.options[guru.selectedIndex];

        namaMapel.value =
            selected.getAttribute('data-mapel') || '';

        idMapel.value =
            selected.getAttribute('data-mapel-id') || '';

        filterSiswa();

    }

    guru.addEventListener('change', tampilMapel);

    tampilMapel();

});


function filterSiswa() {

    let kelas = document.getElementById('id_kelas').value;
    let mapel = document.getElementById('id_mapel').value;

    let siswa = document.querySelectorAll('#siswaDropdown option');

    siswa.forEach(function(item){

        let kelasSiswa = item.getAttribute('data-kelas');
        let mapelSiswa = item.getAttribute('data-mapel');

        let mapelArray = mapelSiswa.split(',');

        if(kelasSiswa == kelas && mapelArray.includes(mapel)) {

            item.disabled = false;
            item.hidden = false;
            $(item).show();

        } else {

            item.disabled = true;
            item.hidden = true;
            item.selected = false;
            $(item).hide();

        }

    });

    if($.fn.selectpicker) {
        $('#siswaDropdown').selectpicker('refresh');
    } else {
        $('#siswaDropdown').trigger('change');
    }

}

document.getElementById('id_kelas')
    .addEventListener('change', filterSiswa);

window.onload = filterSiswa;

</script>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
$(document).ready(function() {
    $('#siswaDropdown').selectpicker();
});
</script>
@endsection