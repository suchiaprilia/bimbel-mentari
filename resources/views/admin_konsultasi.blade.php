@extends('layouts.admin_modern')

@section('judul', 'Data Konsultasi')

@section('konten')

<x-card title="Riwayat Konsultasi Keseluruhan">

<x-table>
  <x-slot name="thead">
    <th>No</th>
    <th>Tanggal</th>
    <th>Siswa (Kelas)</th>
    <th>Guru</th>
    <th>Topik</th>
    <th>Status</th>
    <th width="80">Aksi</th>
  </x-slot>

  @forelse($konsultasi as $row)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d M Y H:i') }}</td>
    <td>
      <strong>{{ $row->siswa->nama_siswa ?? 'Siswa Tidak Ditemukan' }}</strong><br>
      <small class="text-muted">{{ $row->siswa->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</small>
    </td>
    <td>{{ $row->guru->nama_guru ?? 'Guru Tidak Ditemukan' }}</td>
    <td>
      <strong>{{ $row->topik }}</strong><br>
      <small class="text-muted">{{ Str::limit($row->pertanyaan, 50) }}</small>
    </td>
    <td>
      @if($row->status == 'Menunggu')
        <span class="badge badge-warning">Menunggu</span>
      @elseif($row->status == 'Dijawab')
        <span class="badge badge-success">Dijawab</span>
      @else
        <span class="badge badge-secondary">{{ $row->status }}</span>
      @endif
    </td>
    <td class="text-center">
      <div class="dropdown">
        <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
          ⋮
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- Tombol Detail Modal -->
          <button type="button" class="dropdown-item text-info" data-toggle="modal" data-target="#modalDetail{{ $row->id }}">
            👁 Detail
          </button>
          
          <!-- Hapus Konsultasi -->
          <form action="{{ route('admin.konsultasi.destroy', $row->id) }}" method="POST" class="form-delete" data-nama="konsultasi ini">
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

  <!-- Modal Detail Konsultasi -->
  <div class="modal fade" id="modalDetail{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Konsultasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <strong>Topik:</strong> {{ $row->topik }}
          </div>
          <div class="mb-3">
            <strong>Pertanyaan (Siswa/Orang Tua):</strong>
            <div class="p-3 bg-light rounded mt-1">{{ $row->pertanyaan }}</div>
          </div>
          <div class="mb-3">
            <strong>Tanggapan Guru:</strong>
            @if($row->jawaban)
              <div class="p-3 bg-success text-white rounded mt-1">{{ $row->jawaban }}</div>
            @else
              <div class="p-3 bg-warning rounded mt-1">Belum ada tanggapan dari guru.</div>
            @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  @empty
  <tr>
    <td colspan="7" class="text-center text-muted">Belum ada data konsultasi.</td>
  </tr>
  @endforelse

</x-table>

</x-card>

@endsection
