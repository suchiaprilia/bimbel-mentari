<?php $__env->startSection('judul', 'Data Pendaftaran'); ?>

<?php $__env->startSection('konten'); ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Pendaftaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Pendaftaran']); ?>

<?php if(session('success')): ?>
  <div class="alert alert-success">
    <?php echo e(session('success')); ?>

  </div>
<?php endif; ?>

<?php if(session('error')): ?>
  <div class="alert alert-danger">
    <?php echo e(session('error')); ?>

  </div>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Nama Siswa</th>
      <th>Nama Ortu</th>
      <th>WhatsApp</th>
      <th>Jenjang</th>
      <th>Status</th>
      <th>Tanggal</th>
      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $pendaftarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
      <td><?php echo e($loop->iteration); ?></td>
      <td><?php echo e($item->nama_siswa); ?></td>
      <td><?php echo e($item->nama_ortu); ?></td>
      <td><?php echo e($item->no_whatsapp); ?></td>
      <td><?php echo e($item->jenjang); ?></td>

      <td>
        <span class="badge
          <?php echo e($item->status == 'Menunggu' ? 'badge-warning' :
             ($item->status == 'Diterima' ? 'badge-success' : 'badge-danger')); ?>">
          <?php echo e($item->status); ?>

        </span>
      </td>

      <td><?php echo e($item->tanggal_daftar); ?></td>

      <td class="text-center">
        <div class="dropdown">
          <button class="btn btn-light btn-sm" data-toggle="dropdown">⋮</button>

          <div class="dropdown-menu dropdown-menu-right">

            <?php if($item->status == 'Menunggu'): ?>

              
              <form action="<?php echo e(route('pendaftaran.simpanTerima', $item->id)); ?>"
                    method="POST">
                <?php echo csrf_field(); ?>
                <button class="dropdown-item text-success"
                        onclick="return confirm('Terima pendaftaran ini?')">
                  ✔ Terima
                </button>
              </form>

              
              <form action="<?php echo e(route('pendaftaran.tolak', $item->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <button class="dropdown-item text-danger"
                        onclick="return confirm('Tolak pendaftaran ini?')">
                  ✖ Tolak
                </button>
              </form>

            <?php else: ?>
              <span class="dropdown-item text-muted">Sudah diproses</span>
            <?php endif; ?>

          </div>
        </div>
      </td>
    </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
      <td colspan="8" class="text-center text-muted">
        Belum ada data pendaftaran
      </td>
    </tr>
    <?php endif; ?>

  </tbody>
</table>
</div>

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
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/pendaftaran.blade.php ENDPATH**/ ?>