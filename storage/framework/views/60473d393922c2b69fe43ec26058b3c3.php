<?php $__env->startSection('judul', 'Data Nilai Siswa'); ?>

<?php $__env->startSection('konten'); ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Filter Data']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Filter Data']); ?>
  <form action="<?php echo e(route('admin.nilai')); ?>" method="GET">
    <div class="row align-items-end">
      <div class="col-md-4">
        <div class="form-group mb-0">
          <label>Mata Pelajaran</label>
          <select name="id_mapel" class="form-control">
            <option value="">-- Semua Mata Pelajaran --</option>
            <?php $__currentLoopData = $mapels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($mapel->id_mapel); ?>" <?php echo e(request('id_mapel') == $mapel->id_mapel ? 'selected' : ''); ?>>
                <?php echo e($mapel->nama_mapel); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
      </div>
      <div class="col-md-2 mt-2 mt-md-0">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
      </div>
      <?php if(request('id_mapel')): ?>
      <div class="col-md-2 mt-2 mt-md-0">
        <a href="<?php echo e(route('admin.nilai')); ?>" class="btn btn-secondary w-100">Reset</a>
      </div>
      <?php endif; ?>
    </div>
  </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Rekapitulasi Nilai Keseluruhan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Rekapitulasi Nilai Keseluruhan']); ?>

<?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
   <?php $__env->slot('thead', null, []); ?> 
    <th>No</th>
    <th>Tanggal</th>
    <th>Siswa (Kelas)</th>
    <th>Guru</th>
    <th>Mata Pelajaran</th>
    <th>Jenis Nilai</th>
    <th>Nilai</th>
    <th width="80">Aksi</th>
   <?php $__env->endSlot(); ?>

  <?php $__empty_1 = true; $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <tr>
    <td><?php echo e($loop->iteration); ?></td>
    <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('d M Y')); ?></td>
    <td>
      <strong><?php echo e($row->siswa->nama_siswa ?? '-'); ?></strong><br>
      <small class="text-muted"><?php echo e($row->siswa->kelas->nama_kelas ?? '-'); ?></small>
    </td>
    <td><?php echo e($row->guru->nama_guru ?? '-'); ?></td>
    <td><?php echo e($row->mapel->nama_mapel ?? '-'); ?></td>
    <td><?php echo e($row->jenis_nilai); ?></td>
    <td>
      <span class="badge <?php echo e($row->nilai >= 75 ? 'badge-success' : 'badge-danger'); ?> p-2" style="font-size: 14px;">
        <?php echo e($row->nilai); ?>

      </span>
      <?php if($row->keterangan): ?>
        <br><small class="text-muted"><?php echo e($row->keterangan); ?></small>
      <?php endif; ?>
    </td>
    <td class="text-center">
      <div class="dropdown">
        <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
          ⋮
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- Tombol Edit Modal -->
          <button type="button" class="dropdown-item text-primary" data-toggle="modal" data-target="#modalEdit<?php echo e($row->id); ?>">
            ✏ Edit
          </button>
          
          <!-- Hapus Nilai -->
          <form action="<?php echo e(route('admin.nilai.destroy', $row->id)); ?>" method="POST" class="form-delete" data-nama="nilai siswa ini">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="dropdown-item text-danger">
              🗑 Hapus
            </button>
          </form>
        </div>
      </div>
    </td>
  </tr>

  <!-- Modal Edit Nilai -->
  <div class="modal fade" id="modalEdit<?php echo e($row->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="<?php echo e(route('admin.nilai.update', $row->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
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
              <input type="text" class="form-control" value="<?php echo e($row->siswa->nama_siswa ?? '-'); ?>" readonly>
            </div>
            <div class="form-group">
              <label>Jenis Nilai</label>
              <input type="text" name="jenis_nilai" class="form-control" value="<?php echo e($row->jenis_nilai); ?>" required>
            </div>
            <div class="form-group">
              <label>Nilai (Angka)</label>
              <input type="number" name="nilai" class="form-control" value="<?php echo e($row->nilai); ?>" min="0" max="100" required>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" class="form-control" value="<?php echo e($row->keterangan); ?>">
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

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <tr>
    <td colspan="8" class="text-center text-muted">Belum ada data nilai.</td>
  </tr>
  <?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/admin_nilai.blade.php ENDPATH**/ ?>