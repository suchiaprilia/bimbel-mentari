<?php $__env->startSection('judul', 'Data Konsultasi'); ?>

<?php $__env->startSection('konten'); ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Riwayat Konsultasi Keseluruhan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Riwayat Konsultasi Keseluruhan']); ?>

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
    <th>Topik</th>
    <th>Status</th>
    <th width="80">Aksi</th>
   <?php $__env->endSlot(); ?>

  <?php $__empty_1 = true; $__currentLoopData = $konsultasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <tr>
    <td><?php echo e($loop->iteration); ?></td>
    <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('d M Y H:i')); ?></td>
    <td>
      <strong><?php echo e($row->siswa->nama_siswa ?? 'Siswa Tidak Ditemukan'); ?></strong><br>
      <small class="text-muted"><?php echo e($row->siswa->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan'); ?></small>
    </td>
    <td><?php echo e($row->guru->nama_guru ?? 'Guru Tidak Ditemukan'); ?></td>
    <td>
      <strong><?php echo e($row->topik); ?></strong><br>
      <small class="text-muted"><?php echo e(Str::limit($row->pertanyaan, 50)); ?></small>
    </td>
    <td>
      <?php if($row->status == 'Menunggu'): ?>
        <span class="badge badge-warning">Menunggu</span>
      <?php elseif($row->status == 'Dijawab'): ?>
        <span class="badge badge-success">Dijawab</span>
      <?php else: ?>
        <span class="badge badge-secondary"><?php echo e($row->status); ?></span>
      <?php endif; ?>
    </td>
    <td class="text-center">
      <div class="dropdown">
        <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
          ⋮
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <!-- Tombol Detail Modal -->
          <button type="button" class="dropdown-item text-info" data-toggle="modal" data-target="#modalDetail<?php echo e($row->id); ?>">
            👁 Detail
          </button>
          
          <!-- Hapus Konsultasi -->
          <form action="<?php echo e(route('admin.konsultasi.destroy', $row->id)); ?>" method="POST" class="form-delete" data-nama="konsultasi ini">
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

  <!-- Modal Detail Konsultasi -->
  <div class="modal fade" id="modalDetail<?php echo e($row->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
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
            <strong>Topik:</strong> <?php echo e($row->topik); ?>

          </div>
          <div class="mb-3">
            <strong>Pertanyaan (Siswa/Orang Tua):</strong>
            <div class="p-3 bg-light rounded mt-1"><?php echo e($row->pertanyaan); ?></div>
          </div>
          <div class="mb-3">
            <strong>Tanggapan Guru:</strong>
            <?php if($row->jawaban): ?>
              <div class="p-3 bg-success text-white rounded mt-1"><?php echo e($row->jawaban); ?></div>
            <?php else: ?>
              <div class="p-3 bg-warning rounded mt-1">Belum ada tanggapan dari guru.</div>
            <?php endif; ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <tr>
    <td colspan="7" class="text-center text-muted">Belum ada data konsultasi.</td>
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

<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/admin_konsultasi.blade.php ENDPATH**/ ?>