<?php $__env->startSection('judul', $editTagihan ? 'Edit Tagihan' : 'Tagihan Pembayaran'); ?>

<?php $__env->startSection('konten'); ?>

<?php if(session('success')): ?>
<div class="alert alert-success">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<div class="row">
  <div class="col-lg-4">
    <div class="card card-primary">
      <div class="card-header">
        <h5 class="card-title mb-0"><?php echo e($editTagihan ? 'Edit Tagihan' : 'Tambah Tagihan Baru'); ?></h5>
      </div>
      <div class="card-body">
        <form action="<?php echo e($editTagihan ? route('tagihan.update', $editTagihan->id) : route('tagihan.store')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <?php if($editTagihan): ?>
            <?php echo method_field('PUT'); ?>
          <?php endif; ?>

          <div class="form-group">
            <label>Siswa</label>
            <?php if($editTagihan): ?>
              <select name="id_siswa" class="form-control select2" required>
                <option value="">-- Pilih Siswa --</option>
                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($item->id); ?>" <?php echo e(old('id_siswa', $editTagihan->id_siswa ?? '') == $item->id ? 'selected' : ''); ?>>
                    <?php echo e($item->nama_siswa); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            <?php else: ?>
              <select name="id_siswa[]" class="form-control select2-multiple" multiple="multiple" required data-placeholder="-- Pilih Siswa --">
                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($item->id); ?>" <?php echo e(in_array($item->id, old('id_siswa', [])) ? 'selected' : ''); ?>>
                    <?php echo e($item->nama_siswa); ?>

                  </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="mt-2">
                <button type="button" class="btn btn-sm btn-info" id="btn-select-all"><i class="fas fa-check-double"></i> Pilih Semua</button>
                <button type="button" class="btn btn-sm btn-secondary" id="btn-clear-all"><i class="fas fa-eraser"></i> Batalkan Semua</button>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required
                   value="<?php echo e(old('jumlah', $editTagihan->jumlah ?? '')); ?>">
          </div>

          <div class="form-group">
            <label>Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" class="form-control" required
                   value="<?php echo e(old('tanggal_jatuh_tempo', $editTagihan->tanggal_jatuh_tempo ?? '')); ?>">
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea class="form-control" rows="3" disabled>Tagihan dibuat oleh admin, kemudian siswa mengunggah bukti transfer atau admin menandai lunas.</textarea>
          </div>

          <div class="text-right">
            <button class="btn btn-success btn-sm"><?php echo e($editTagihan ? 'Perbarui Tagihan' : 'Simpan Tagihan'); ?></button>
            <?php if($editTagihan): ?>
              <a href="<?php echo e(route('tagihan.index')); ?>" class="btn btn-secondary btn-sm">Batal</a>
            <?php endif; ?>
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
              <?php $__empty_1 = true; $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($item->siswa->nama_siswa ?? '-'); ?></td>
                <td>Rp <?php echo e(number_format($item->jumlah, 0, ',', '.')); ?></td>
                <td><?php echo e($item->tanggal_jatuh_tempo); ?></td>
                <td>
                  <span class="badge badge-<?php echo e($item->status == 'Lunas' ? 'success' : ($item->status == 'Menunggu' ? 'warning' : 'danger')); ?>">
                    <?php echo e($item->status); ?>

                  </span>
                </td>
                <td>
                  <a href="<?php echo e(route('tagihan.edit', $item->id)); ?>" class="btn btn-sm btn-primary">Edit</a>
                  <form action="<?php echo e(route('tagihan.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus tagihan ini?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="6" class="text-center">Belum ada tagihan.</td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/tagihan.blade.php ENDPATH**/ ?>