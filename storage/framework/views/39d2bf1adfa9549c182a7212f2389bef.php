<?php ($editKelas = $editKelas ?? null); ?>

<?php $__env->startSection('judul', 'Data Kelas'); ?>

<?php $__env->startSection('konten'); ?>


<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($editKelas ? 'Edit Kelas' : 'Tambah Kelas').'','collapse' => 'true','id' => 'formKelas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($editKelas ? 'Edit Kelas' : 'Tambah Kelas').'','collapse' => 'true','id' => 'formKelas']); ?>

<form 
  action="<?php echo e($editKelas ? route('kelas.update', $editKelas->id) : route('kelas.store')); ?>" 
  method="POST"
  class="form-crud"
  data-title="<?php echo e($editKelas ? 'Ubah data kelas?' : 'Simpan data kelas?'); ?>"
  data-text="<?php echo e($editKelas ? 'Data kelas akan diperbarui.' : 'Data kelas akan ditambahkan.'); ?>"
>
  <?php echo csrf_field(); ?>
  <?php if($editKelas): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>Nama Kelas</label>
        <input 
          type="text" 
          name="nama_kelas" 
          class="form-control <?php $__errorArgs = ['nama_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('nama_kelas', $editKelas->nama_kelas ?? '')); ?>" 
          required
        >

        <?php $__errorArgs = ['nama_kelas'];
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
      <i class="fas fa-save"></i> <?php echo e($editKelas ? 'Update' : 'Simpan'); ?>

    </button>

    <a 
      href="<?php echo e(route('kelas.index', ['batal' => $editKelas ? 'edit' : 'tambah'])); ?>" 
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Kelas']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Kelas']); ?>

<div class="table-responsive">
<table class="table table-bordered table-hover">
  <thead class="bg-light">
    <tr>
      <th>No</th>
      <th>Nama Kelas</th>
      <th width="80">Aksi</th>
    </tr>
  </thead>

  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>

      <td><?php echo e($loop->iteration); ?></td>
      <td><?php echo e($row->nama_kelas); ?></td>

      <td class="text-center">
        <div class="dropdown">
          <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="<?php echo e(route('kelas.edit', $row->id)); ?>" class="dropdown-item">
              ✏ Edit
            </a>

            <form 
              action="<?php echo e(route('kelas.destroy', $row->id)); ?>" 
              method="POST"
              class="form-delete"
              data-nama="data kelas <?php echo e($row->nama_kelas); ?>"
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
      <td colspan="3" class="text-center text-muted">
        Belum ada data kelas
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
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/kelas.blade.php ENDPATH**/ ?>