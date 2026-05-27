@extends('layouts.admin_modern')

@section('judul', 'Data Nilai Siswa')

@section('konten')

<x-card title="Filter Data">
  <form action="{{ route('admin.nilai') }}" method="GET">
    <div class="row align-items-end">
      <div class="col-md-4">
        <div class="form-group mb-0">
          <label>Mata Pelajaran</label>
          <select name="id_mapel" class="form-control">
            <option value="">-- Semua Mata Pelajaran --</option>
            @foreach($mapels as $mapel)
              <option value="{{ $mapel->id_mapel }}" {{ request('id_mapel') == $mapel->id_mapel ? 'selected' : '' }}>
                {{ $mapel->nama_mapel }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-2 mt-2 mt-md-0">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
      </div>
      @if(request('id_mapel'))
      <div class="col-md-2 mt-2 mt-md-0">
        <a href="{{ route('admin.nilai') }}" class="btn btn-secondary w-100">Reset</a>
      </div>
      @endif
    </div>
  </form>
</x-card>

<x-card title="Rekapitulasi Nilai Keseluruhan">

<x-table>
  <x-slot name="thead">
    <th>No</th>
    <th>Tanggal</th>
    <th>Siswa (Kelas)</th>
    <th>Guru</th>
    <th>Mata Pelajaran</th>
    <th>Jenis Nilai</th>
    <th>Nilai</th>
    <th width="80">Aksi</th>
  </x-slot>

  @forelse($nilai as $row)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</td>
    <td>
      <strong>{{ $row->siswa->nama_siswa ?? '-' }}</strong><br>
      <small class="text-muted">{{ $row->siswa->kelas->nama_kelas ?? '-' }}</small>
    </td>
    <td>{{ $row->guru->nama_guru ?? '-' }}</td>
    <td>{{ $row->mapel->nama_mapel ?? '-' }}</td>
    <td>{{ $row->jenis_nilai }}</td>
    <td>
      <span class="badge {{ $row->nilai >= 75 ? 'badge-success' : 'badge-danger' }} p-2" style="font-size: 14px;">
        {{ $row->nilai }}
      </span>
      @if($row->keterangan)
        <br><small class="text-muted">{{ $row->keterangan }}</small>
      @endif
    </td>
    <td class="text-center">
      <div class="dropdown">
        <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
          ⋮
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- Tombol Edit Modal -->
          <button type="button" class="dropdown-item text-primary" data-toggle="modal" data-target="#modalEdit{{ $row->id }}">
            ✏ Edit
          </button>
          
          <!-- Hapus Nilai -->
          <form action="{{ route('admin.nilai.destroy', $row->id) }}" method="POST" class="form-delete" data-nama="nilai siswa ini">
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

  <!-- Modal Edit Nilai -->
  <div class="modal fade" id="modalEdit{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{ route('admin.nilai.update', $row->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Nilai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Siswa</label>
              <input type="text" class="form-control" value="{{ $row->siswa->nama_siswa ?? '-' }}" readonly>
            </div>
            <div class="form-group">
              <label>Jenis Nilai</label>
              <input type="text" name="jenis_nilai" class="form-control" value="{{ $row->jenis_nilai }}" required>
            </div>
            <div class="form-group">
              <label>Nilai (Angka)</label>
              <input type="number" name="nilai" class="form-control" value="{{ $row->nilai }}" min="0" max="100" required>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" class="form-control" value="{{ $row->keterangan }}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  @empty
  <tr>
    <td colspan="8" class="text-center text-muted">Belum ada data nilai.</td>
  </tr>
  @endforelse

</x-table>

</x-card>

@endsection
