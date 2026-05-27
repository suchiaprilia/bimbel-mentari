<?php ($editSiswa = $editSiswa ?? null); ?>

<?php $__env->startSection('judul', 'Data Siswa'); ?>

<?php $__env->startSection('konten'); ?>


<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($editSiswa ? 'Edit Siswa' : 'Tambah Siswa').'','collapse' => 'true','id' => 'formSiswa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($editSiswa ? 'Edit Siswa' : 'Tambah Siswa').'','collapse' => 'true','id' => 'formSiswa']); ?>

<form 
  action="<?php echo e($editSiswa ? route('siswa.update', $editSiswa->id) : route('siswa.store')); ?>" 
  method="POST"
  class="form-crud"
  data-title="<?php echo e($editSiswa ? 'Ubah data siswa?' : 'Simpan data siswa?'); ?>"
  data-text="<?php echo e($editSiswa ? 'Data siswa akan diperbarui.' : 'Data siswa akan ditambahkan.'); ?>"
>
  <?php echo csrf_field(); ?>
  <?php if($editSiswa): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label>Kelas</label>
        <select name="id_kelas" class="form-control <?php $__errorArgs = ['id_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
          <option value="">-- Pilih Kelas --</option>
          <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($k->id); ?>"
              <?php echo e(old('id_kelas', $editSiswa->id_kelas ?? '') == $k->id ? 'selected' : ''); ?>>
              <?php echo e($k->nama_kelas); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <?php $__errorArgs = ['id_kelas'];
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

    <div class="col-md-4">
      <div class="form-group">
        <label>Nama Siswa</label>
        <input 
          type="text" 
          name="nama_siswa" 
          class="form-control <?php $__errorArgs = ['nama_siswa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('nama_siswa', $editSiswa->nama_siswa ?? '')); ?>" 
          required
        >

        <?php $__errorArgs = ['nama_siswa'];
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

    <div class="col-md-4">
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
          value="<?php echo e(old('no_whatsapp', $editSiswa->no_whatsapp ?? '')); ?>" 
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

    <div class="col-md-8">
      <div class="form-group">
        <label>Alamat</label>
        <textarea 
          name="alamat" 
          class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
          rows="2"
        ><?php echo e(old('alamat', $editSiswa->alamat ?? '')); ?></textarea>

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

    <div class="col-md-4">
      <div class="form-group">
        <label>Status</label>
        <select name="status" class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
          <option value="aktif" <?php echo e(old('status', $editSiswa->status ?? 'aktif') == 'aktif' ? 'selected' : ''); ?>>
            Aktif
          </option>
          <option value="nonaktif" <?php echo e(old('status', $editSiswa->status ?? '') == 'nonaktif' ? 'selected' : ''); ?>>
            Nonaktif
          </option>
        </select>

        <?php $__errorArgs = ['status'];
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
      <?php echo e($editSiswa ? 'Update' : 'Simpan'); ?>

    </button>

    <a 
      href="<?php echo e(route('siswa.index', ['batal' => $editSiswa ? 'edit' : 'tambah'])); ?>" 
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Lengkap Siswa']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Lengkap Siswa']); ?>

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

  <th>Kelas</th>
  <th>Nama</th>
  <th>Mapel Diikuti</th>
  <th>Alamat</th>
  <th>WhatsApp</th>
  <th>Status</th>
  <th width="80">Aksi</th>
 <?php $__env->endSlot(); ?>

<?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<tr>

  <td><?php echo e($loop->iteration); ?></td>


  <td>
    <?php echo e($row->kelas->nama_kelas ?? '-'); ?>

  </td>

  <td>
    <?php echo e($row->nama_siswa); ?>

  </td>

  <td>
    <?php $__empty_2 = true; $__currentLoopData = $row->mapels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

      <span class="badge badge-info">
        <?php echo e($m->nama_mapel); ?>

      </span>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>

      <span class="text-muted">
        Tidak ada mapel
      </span>

    <?php endif; ?>
  </td>

  <td>
    <?php echo e($row->alamat ?? '-'); ?>

  </td>

  <td>
    <?php echo e($row->no_whatsapp); ?>

  </td>

  
  <td>
    <?php ($status = strtolower($row->status)); ?>

    <span class="badge <?php echo e($status == 'aktif' ? 'badge-success' : 'badge-danger'); ?>">
      <?php echo e($status == 'aktif' ? 'Aktif' : 'Nonaktif'); ?>

    </span>
  </td>

  
  <td class="text-center">
    <div class="dropdown">
      <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
        ⋮
      </button>

      <div class="dropdown-menu dropdown-menu-right">

        <a href="<?php echo e(route('siswa.edit', $row->id)); ?>" class="dropdown-item">
          ✏ Edit
        </a>

        <form 
          action="<?php echo e(route('siswa.destroy', $row->id)); ?>" 
          method="POST"
          class="form-delete"
          data-nama="data siswa <?php echo e($row->nama_siswa); ?>"
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
  <td colspan="9" class="text-center text-muted">
    Belum ada data siswa
  </td>
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
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/siswa.blade.php ENDPATH**/ ?>