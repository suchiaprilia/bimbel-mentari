<?php ($editGuru = $editGuru ?? null); ?>

<?php $__env->startSection('judul', 'Data Guru'); ?>

<?php $__env->startSection('konten'); ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($editGuru ? 'Edit Guru' : 'Tambah Guru').'','collapse' => 'true','id' => 'formGuru']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($editGuru ? 'Edit Guru' : 'Tambah Guru').'','collapse' => 'true','id' => 'formGuru']); ?>

<form 
  action="<?php echo e($editGuru ? route('guru.update', $editGuru->id) : route('guru.store')); ?>" 
  method="POST"
  class="form-crud"
  data-title="<?php echo e($editGuru ? 'Ubah data guru?' : 'Simpan data guru?'); ?>"
  data-text="<?php echo e($editGuru ? 'Data guru akan diperbarui.' : 'Data guru akan ditambahkan.'); ?>"
>

  <?php echo csrf_field(); ?>

  <?php if($editGuru): ?>
    <?php echo method_field('PUT'); ?>
  <?php endif; ?>

  <div class="row">

    
    <div class="col-md-6">
      <div class="form-group">

        <label>Nama Guru</label>

        <input 
          type="text"
          name="nama_guru"
          class="form-control <?php $__errorArgs = ['nama_guru'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('nama_guru', $editGuru->nama_guru ?? '')); ?>"
          required
        >

        <?php $__errorArgs = ['nama_guru'];
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


    
    <div class="col-md-6">
      <div class="form-group">

        <label>Mata Pelajaran</label>

        <select 
          name="id_mapel"
          class="form-control <?php $__errorArgs = ['id_mapel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          required
        >

          <option value="">-- Pilih Mapel --</option>

          <?php $__currentLoopData = $mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($m->id_mapel); ?>"
              <?php echo e(old('id_mapel', $editGuru->id_mapel ?? '') == $m->id_mapel ? 'selected' : ''); ?>>

              <?php echo e($m->nama_mapel); ?>


            </option>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

        <?php $__errorArgs = ['id_mapel'];
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


    
    <div class="col-md-6">
      <div class="form-group">

        <label>No WhatsApp</label>

        <input 
          type="text"
          name="no_whatsapp"
          class="form-control <?php $__errorArgs = ['no_whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('no_whatsapp', $editGuru->no_whatsapp ?? '')); ?>"
          required
        >

        <?php $__errorArgs = ['no_whatsapp'];
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


    
    <div class="col-md-12">
      <div class="form-group">

        <label>Alamat</label>

        <textarea 
          name="alamat"
          rows="3"
          class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        ><?php echo e(old('alamat', $editGuru->alamat ?? '')); ?></textarea>

        <?php $__errorArgs = ['alamat'];
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
      <?php echo e($editGuru ? 'Update' : 'Simpan'); ?>

    </button>

    <a 
      href="<?php echo e(route('guru.index')); ?>"
      class="btn btn-secondary btn-sm"
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Guru']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Guru']); ?>

<div class="table-responsive">

<table class="table table-bordered table-hover">

  <thead class="bg-light">

    <tr>

      <th>No</th>
      <th>Nama Guru</th>
      <th>Mapel</th>
      <th>No WhatsApp</th>
      <th>Alamat</th>
      <th width="80">Aksi</th>

    </tr>

  </thead>

  <tbody>

    <?php $__empty_1 = true; $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    <tr>

      <td><?php echo e($loop->iteration); ?></td>

      <td><?php echo e($row->nama_guru); ?></td>

      <td>
        <?php echo e($row->mapel->nama_mapel ?? '-'); ?>

      </td>

      <td><?php echo e($row->no_whatsapp); ?></td>

      <td><?php echo e($row->alamat ?? '-'); ?></td>

      <td class="text-center">

        <div class="dropdown">

          <button type="button"
                  class="btn btn-light btn-sm"
                  data-toggle="dropdown">

            ⋮

          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="<?php echo e(route('guru.edit', $row->id)); ?>"
               class="dropdown-item">

              ✏ Edit

            </a>

            <form 
              action="<?php echo e(route('guru.destroy', $row->id)); ?>"
              method="POST"
              class="form-delete"
              data-nama="data guru <?php echo e($row->nama_guru); ?>"
            >

              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>

              <button type="submit"
                      class="dropdown-item text-danger">

                🗑 Hapus

              </button>

            </form>

          </div>

        </div>

      </td>

    </tr>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

    <tr>

      <td colspan="6" class="text-center text-muted">
        Belum ada data guru
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
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/guru.blade.php ENDPATH**/ ?>