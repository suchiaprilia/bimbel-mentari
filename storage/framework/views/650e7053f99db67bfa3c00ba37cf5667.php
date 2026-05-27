<?php ($editPembayaran = $editPembayaran ?? null); ?>

<?php $__env->startSection('judul', 'Data Pembayaran'); ?>

<?php $__env->startSection('konten'); ?>

<?php if(session('success')): ?>
<div class="alert alert-success">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<div class="mb-3 d-flex justify-content-between align-items-center">
  <form action="<?php echo e(route('pembayaran.reminder')); ?>" method="POST" class="d-inline">
    <?php echo csrf_field(); ?>
    <button type="submit" class="btn btn-warning btn-sm">
      Kirim Pengingat Pembayaran WA
    </button>
  </form>
  <a href="<?php echo e(route('tagihan.index')); ?>" class="btn btn-info btn-sm">
    <i class="fas fa-plus-circle"></i> Buat Tagihan Baru
  </a>
</div>


<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Pembayaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Pembayaran']); ?>

<div class="table-responsive">
<table class="table table-hover align-middle">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Siswa</th>
      <th>Jumlah</th>
      <th>Metode</th>
      <th>Status</th>
      <th>Jatuh Tempo</th>
      <th>Bukti</th>
      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php $__currentLoopData = $pembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>

      <td><?php echo e($loop->iteration); ?></td>
      <td><?php echo e($row->siswa->nama_siswa ?? '-'); ?></td>
      <td>Rp <?php echo e(number_format($row->jumlah,0,',','.')); ?></td>
      <td><?php echo e(ucfirst($row->metode_pembayaran)); ?></td>

      <td>
        <span class="badge 
          <?php echo e($row->status == 'Lunas' ? 'badge-success' : 
             ($row->status == 'Menunggu' ? 'badge-warning' : 'badge-danger')); ?>">
          <?php echo e($row->status); ?>

        </span>
      </td>

      <td><?php echo e($row->tanggal_jatuh_tempo); ?></td>

      <td>
        <?php if($row->bukti_transfer): ?>
          <a href="<?php echo e(asset('storage/'.$row->bukti_transfer)); ?>" target="_blank" class="btn btn-info btn-sm">
            Lihat
          </a>
        <?php else: ?>
          -
        <?php endif; ?>
      </td>

      
      <td class="text-center">
        <div class="dropdown">
          <button class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <?php if($row->status == 'Menunggu'): ?>
              <form action="<?php echo e(route('pembayaran.verifikasi', $row->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="dropdown-item text-success">✔ Verifikasi</button>
              </form>
            <?php endif; ?>

            <?php if($row->status != 'Lunas'): ?>
              <form action="<?php echo e(route('pembayaran.bayarTunai', $row->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="dropdown-item text-primary">💵 Bayar Tunai</button>
              </form>
            <?php endif; ?>

            <a href="<?php echo e(route('tagihan.edit', $row->id)); ?>" 
               class="dropdown-item">✏ Edit Tagihan</a>

            <form action="<?php echo e(route('tagihan.destroy', $row->id)); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button class="dropdown-item text-danger" onclick="return confirm('Hapus data?')">
                🗑 Hapus
              </button>
            </form>

          </div>
        </div>
      </td>

    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/pembayaran.blade.php ENDPATH**/ ?>