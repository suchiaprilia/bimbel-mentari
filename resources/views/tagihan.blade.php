@extends('layouts.admin_modern')

@section('judul', $editTagihan ? 'Edit Tagihan' : 'Tagihan Pembayaran')

@section('konten')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row">
  <div class="col-lg-4">
    <div class="card card-primary">
      <div class="card-header">
        <h5 class="card-title mb-0">{{ $editTagihan ? 'Edit Tagihan' : 'Tambah Tagihan Baru' }}</h5>
      </div>
      <div class="card-body">
        <form action="{{ $editTagihan ? route('tagihan.update', $editTagihan->id) : route('tagihan.store') }}" method="POST">
          @csrf
          @if($editTagihan)
            @method('PUT')
          @endif

          <div class="form-group">
            <label>Siswa</label>
            @if($editTagihan)
              <select name="id_siswa" class="form-control select2" required>
                <option value="">-- Pilih Siswa --</option>
                @foreach($siswa as $item)
                  <option value="{{ $item->id }}" {{ old('id_siswa', $editTagihan->id_siswa ?? '') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_siswa }}
                  </option>
                @endforeach
              </select>
            @else
              <select name="id_siswa[]" class="form-control select2-multiple" multiple="multiple" required data-placeholder="-- Pilih Siswa --">
                @foreach($siswa as $item)
                  <option value="{{ $item->id }}" {{ in_array($item->id, old('id_siswa', [])) ? 'selected' : '' }}>
                    {{ $item->nama_siswa }}
                  </option>
                @endforeach
              </select>
              <div class="mt-2">
                <button type="button" class="btn btn-sm btn-info" id="btn-select-all"><i class="fas fa-check-double"></i> Pilih Semua</button>
                <button type="button" class="btn btn-sm btn-secondary" id="btn-clear-all"><i class="fas fa-eraser"></i> Batalkan Semua</button>
              </div>
            @endif
          </div>

          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required
                   value="{{ old('jumlah', $editTagihan->jumlah ?? '') }}">
          </div>

          <div class="form-group">
            <label>Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="form-control" required
                   value="{{ old('tanggal_jatuh_tempo', $editTagihan->tanggal_jatuh_tempo ?? '') }}">
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" rows="3" disabled>Tagihan dibuat oleh admin, kemudian siswa mengunggah bukti transfer atau admin menandai lunas.</textarea>
          </div>

          <div class="text-right">
            <button class="btn btn-success btn-sm">{{ $editTagihan ? 'Perbarui Tagihan' : 'Simpan Tagihan' }}</button>
            @if($editTagihan)
              <a href="{{ route('tagihan.index') }}" class="btn btn-secondary btn-sm">Batal</a>
            @endif
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-8">
    <div class="card card-secondary">
      <div class="card-header">
        <h5 class="card-title mb-0">Daftar Tagihan</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Siswa</th>
                <th>Jumlah</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th width="160">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($tagihan as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->siswa->nama_siswa ?? '-' }}</td>
                <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->tanggal_jatuh_tempo }}</td>
                <td>
                  <span class="badge badge-{{ $item->status == 'Lunas' ? 'success' : ($item->status == 'Menunggu' ? 'warning' : 'danger') }}">
                    {{ $item->status }}
                  </span>
                </td>
                <td>
                  <a href="{{ route('tagihan.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                  <form action="{{ route('tagihan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tagihan ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">Belum ada tagihan.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    .select2-container .select2-selection--multiple {
        border-radius: 12px !important;
        border: 1px solid #d8e0ea !important;
        min-height: 44px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #003b70;
        border: none;
        color: white;
        border-radius: 6px;
        padding: 4px 8px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white;
        margin-right: 5px;
    }
    .select2-container .select2-selection--single {
        border-radius: 12px !important;
        border: 1px solid #d8e0ea !important;
        height: 44px;
        padding: 6px;
    }
</style>
<script>
$(document).ready(function() {
    $('.select2').select2({
        width: '100%'
    });
    $('.select2-multiple').select2({
        width: '100%',
        placeholder: "-- Pilih Siswa --"
    });

    $('#btn-select-all').click(function() {
        var allOptions = [];
        $('.select2-multiple option').each(function() {
            if ($(this).val()) {
                allOptions.push($(this).val());
            }
        });
        $('.select2-multiple').val(allOptions).trigger('change');
    });

    $('#btn-clear-all').click(function() {
        $('.select2-multiple').val(null).trigger('change');
    });
});
</script>
@endsection

@endsection
