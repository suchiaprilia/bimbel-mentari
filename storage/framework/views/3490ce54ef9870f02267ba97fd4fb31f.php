<?php ($editMateri = $editMateri ?? null); ?>

<?php $__env->startSection('judul', 'Data Materi'); ?>

<?php $__env->startSection('konten'); ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($editMateri ? 'Edit Materi' : 'Tambah Materi').'','collapse' => 'true','id' => 'formMateri']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($editMateri ? 'Edit Materi' : 'Tambah Materi').'','collapse' => 'true','id' => 'formMateri']); ?>

<form 
  action="<?php echo e($editMateri ? route('materi.update', $editMateri->id) : route('materi.store')); ?>"
  method="POST" 
  enctype="multipart/form-data"
  class="form-crud"
  data-title="<?php echo e($editMateri ? 'Ubah data materi?' : 'Simpan data materi?'); ?>"
  data-text="<?php echo e($editMateri ? 'Data materi akan diperbarui.' : 'Data materi akan ditambahkan.'); ?>"
>
  <?php echo csrf_field(); ?>
  <?php if($editMateri): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

  <div class="row">

    
    <div class="col-md-3">
      <div class="form-group">

        <label>Guru</label>

        <select 
          name="id_guru" 
          id="id_guru"
          class="form-control <?php $__errorArgs = ['id_guru'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
          required
        >

          <option value="">-- Pilih Guru --</option>

          <?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option 
              value="<?php echo e($g->id); ?>"
              data-mapel="<?php echo e($g->mapel->nama_mapel ?? '-'); ?>"
              <?php echo e(old('id_guru', $editMateri->id_guru ?? '') == $g->id ? 'selected' : ''); ?>

            >

              <?php echo e($g->nama_guru); ?>


            </option>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

        <?php $__errorArgs = ['id_guru'];
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

    
    <div class="col-md-3">
      <div class="form-group">

        <label>Mata Pelajaran</label>

        <input 
          type="text"
          id="nama_mapel"
          class="form-control"
          readonly
          value="<?php echo e($editMateri->guru->mapel->nama_mapel ?? ''); ?>"
        >

      </div>
    </div>

    
    <div class="col-md-3">
      <div class="form-group">
        <label>Kelas</label>

        <select 
          name="id_kelas" 
          class="form-control <?php $__errorArgs = ['id_kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
          required
        >

          <option value="">-- Pilih Kelas --</option>

          <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option value="<?php echo e($k->id); ?>"
              <?php echo e(old('id_kelas', $editMateri->id_kelas ?? '') == $k->id ? 'selected' : ''); ?>>

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

    
    <div class="col-md-3">
      <div class="form-group">

        <label>Tanggal Upload</label>

        <input 
          type="date" 
          name="tanggal_upload" 
          class="form-control <?php $__errorArgs = ['tanggal_upload'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('tanggal_upload', $editMateri->tanggal_upload ?? date('Y-m-d'))); ?>" 
          required
        >

        <?php $__errorArgs = ['tanggal_upload'];
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

        <label>Judul Materi</label>

        <input 
          type="text" 
          name="judul_materi" 
          class="form-control <?php $__errorArgs = ['judul_materi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
          value="<?php echo e(old('judul_materi', $editMateri->judul_materi ?? '')); ?>" 
          required
        >

        <?php $__errorArgs = ['judul_materi'];
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

        <label>File Materi</label>

        <input 
          type="file" 
          name="file_materi" 
          class="form-control <?php $__errorArgs = ['file_materi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        >

        <?php if($editMateri && $editMateri->file_materi): ?>

          <small class="text-muted">
            File lama: <b><?php echo e(basename($editMateri->file_materi)); ?></b>
          </small>

        <?php endif; ?>

        <?php $__errorArgs = ['file_materi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
          <small class="text-danger d-block"><?php echo e($message); ?></small>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

      </div>
    </div>

    
    <div class="col-md-12">
      <div class="form-group">

        <label>Deskripsi</label>

        <textarea 
          name="deskripsi" 
          class="form-control <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
          rows="3"
        ><?php echo e(old('deskripsi', $editMateri->deskripsi ?? '')); ?></textarea>

        <?php $__errorArgs = ['deskripsi'];
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
      <i class="fas fa-save"></i> <?php echo e($editMateri ? 'Update' : 'Simpan'); ?>

    </button>

    <a 
      href="<?php echo e(route('materi.index', ['batal' => $editMateri ? 'edit' : 'tambah'])); ?>" 
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Materi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Materi']); ?>

<div class="table-responsive">

<table class="table table-bordered table-hover">

  <thead class="bg-light">

    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Judul</th>
      <th>Kelas</th>
      <th>Mapel</th>
      <th>Guru</th>
      <th>File</th>
      <th width="80">Aksi</th>
    </tr>

  </thead>

  <tbody>

    <?php $__empty_1 = true; $__currentLoopData = $materi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    <tr>

      <td><?php echo e($loop->iteration); ?></td>

      <td><?php echo e($row->tanggal_upload); ?></td>

      <td><?php echo e($row->judul_materi); ?></td>

      <td><?php echo e($row->kelas->nama_kelas ?? '-'); ?></td>

      <td><?php echo e($row->guru->mapel->nama_mapel ?? '-'); ?></td>

      <td><?php echo e($row->guru->nama_guru ?? '-'); ?></td>

      <td>

        <?php if($row->file_materi): ?>

          <a href="<?php echo e(route('materi.download', $row->id)); ?>" class="btn btn-info btn-sm">
            ⬇
          </a>

        <?php else: ?>
          -
        <?php endif; ?>

      </td>

      <td class="text-center">

        <div class="dropdown">

          <button type="button" class="btn btn-light btn-sm" data-toggle="dropdown">
            ⋮
          </button>

          <div class="dropdown-menu dropdown-menu-right">

            <a href="<?php echo e(route('materi.edit', $row->id)); ?>" class="dropdown-item">
              ✏ Edit
            </a>

            <?php if($row->file_materi): ?>

              <a href="<?php echo e(route('materi.download', $row->id)); ?>" class="dropdown-item">
                ⬇ Download
              </a>

            <?php endif; ?>

            <form 
              action="<?php echo e(route('materi.destroy', $row->id)); ?>" 
              method="POST"
              class="form-delete"
              data-nama="materi <?php echo e($row->judul_materi); ?>"
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

      <td colspan="8" class="text-center text-muted">
        Belum ada data materi
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

<script>

document.addEventListener('DOMContentLoaded', function () {

    const guru = document.getElementById('id_guru');
    const mapel = document.getElementById('nama_mapel');

    function tampilMapel() {

        const selected = guru.options[guru.selectedIndex];

        mapel.value = selected.getAttribute('data-mapel') || '';

    }

    guru.addEventListener('change', tampilMapel);

    tampilMapel();

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/materi.blade.php ENDPATH**/ ?>