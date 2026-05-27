<?php ($editMapel = $editMapel ?? null); ?>

<?php $__env->startSection('judul', 'Data Mata Pelajaran'); ?>

<?php $__env->startSection('konten'); ?>


<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($editMapel ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran').'','collapse' => 'true','id' => 'formMapel']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($editMapel ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran').'','collapse' => 'true','id' => 'formMapel']); ?>

<form 
  action="<?php echo e($editMapel ? route('mapel.update', $editMapel->id_mapel) : route('mapel.store')); ?>" 
  method="POST"
  class="form-crud"
  data-title="<?php echo e($editMapel ? 'Ubah data mata pelajaran?' : 'Simpan data mata pelajaran?'); ?>"
  data-text="<?php echo e($editMapel ? 'Data mata pelajaran akan diperbarui.' : 'Data mata pelajaran akan ditambahkan.'); ?>"
>
  <?php echo csrf_field(); ?>
  <?php if($editMapel): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

  <div class="row">

    <div class="col-md-8">
      <div class="form-group">
        <label>Nama Mata Pelajaran</label>
        <input 
          type="text" 
          name="nama_mapel" 
          class="form-control <?php $__errorArgs = ['nama_mapel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('nama_mapel', $editMapel->nama_mapel ?? '')); ?>" 
          required
        >
        <?php $__errorArgs = ['nama_mapel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <small class="text-danger"><?php echo e($message); ?></small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
      </div>
    </div>

  </div>

  <div class="mt-2 text-right">
    <button type="submit" class="btn btn-success btn-sm">
      <i class="fas fa-save"></i> <?php echo e($editMapel ? 'Update' : 'Simpan'); ?>

    </button>

    <a 
      href="<?php echo e(route('mapel.index', ['batal' => $editMapel ? 'edit' : 'tambah'])); ?>" 
      class="btn btn-secondary btn-sm btn-batal"
    >
      Batal
    </a>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Mata Pelajaran']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Mata Pelajaran']); ?>

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Nama Mapel</th>

      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>

      <td><?php echo e($loop->iteration); ?></td>
      <td><?php echo e($row->nama_mapel); ?></td>


      <td class="text-center">
        <div class="dropdown">
          <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="<?php echo e(route('mapel.edit', $row->id_mapel)); ?>" class="dropdown-item">
              ✏ Edit
            </a>

            <form 
              action="<?php echo e(route('mapel.destroy', $row->id_mapel)); ?>" 
              method="POST"
              class="form-delete"
              data-nama="mata pelajaran <?php echo e($row->nama_mapel); ?>"
            >
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

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
      <td colspan="4" class="text-center text-muted">
        Belum ada data mata pelajaran
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
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/mapel.blade.php ENDPATH**/ ?>