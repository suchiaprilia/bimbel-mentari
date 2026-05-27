<?php $__env->startSection('judul', 'Arsip Absensi'); ?>

<?php $__env->startSection('konten'); ?>

<!-- Modals -->
<div class="modal fade" id="modalUploadArsip" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Arsip Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/arsip-absensi/store" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Judul Arsip <span class="text-danger">*</span></label>
                        <input type="text" name="judul_arsip" class="form-control" required placeholder="Contoh: Absensi Kelas 10 Mat 18 Mei">
                    </div>
                    <div class="form-group mb-3">
                        <label>Tanggal Kelas <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control" required value="<?php echo e(date('Y-m-d')); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label>File Arsip (Max 5MB) <span class="text-danger">*</span></label>
                        <input type="file" name="file_arsip" class="form-control" required accept=".pdf,.xls,.xlsx,.jpg,.jpeg,.png">
                        <small class="form-text text-muted">Format didukung: PDF, Excel, JPG, PNG.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUploadArsip">
        <i class="fas fa-upload mr-1"></i> Upload Arsip Baru
    </button>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Daftar Arsip Absensi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Arsip Absensi']); ?>
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
            <th>Judul Arsip</th>
            <th>Tanggal</th>
            <th>Waktu Upload</th>
            <th>Diunggah Oleh</th>
            <th width="150" class="text-center">Aksi</th>
         <?php $__env->endSlot(); ?>

        <?php $__empty_1 = true; $__currentLoopData = $arsip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><strong><?php echo e($a->judul_arsip); ?></strong></td>
            <td><?php echo e(\Carbon\Carbon::parse($a->tanggal)->format('d F Y')); ?></td>
            <td><?php echo e(\Carbon\Carbon::parse($a->created_at)->format('d M Y H:i')); ?></td>
            <td>
                <?php if($a->user): ?>
                    <span class="badge badge-secondary"><?php echo e(ucfirst($a->user->level)); ?></span>
                <?php else: ?>
                    <span class="text-muted">-</span>
                <?php endif; ?>
            </td>
            <td class="text-center">
                <?php
                    $extension = pathinfo($a->file_path, PATHINFO_EXTENSION);
                    $isPreviewable = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'pdf']);
                ?>
                <div class="btn-group" role="group">
                    <?php if($isPreviewable): ?>
                        <button type="button" class="btn btn-info btn-sm" title="Preview File" onclick="openPreviewAdmin('<?php echo e(Storage::url($a->file_path)); ?>', '<?php echo e(strtolower($extension)); ?>')">
                            <i class="fas fa-eye"></i>
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e(Storage::url($a->file_path)); ?>" target="_blank" class="btn btn-success btn-sm" title="Download File">
                            <i class="fas fa-download"></i>
                        </a>
                    <?php endif; ?>
                    <form action="/arsip-absensi/<?php echo e($a->id); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Arsip">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="6" class="text-center text-muted">Belum ada arsip absensi yang diunggah.</td>
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

<!-- Preview Modal Admin -->
<div class="modal fade" id="modalPreviewAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Arsip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="previewContainerAdmin" style="min-height: 200px; max-height: 70vh; overflow-y: auto;">
                <!-- Content injected via JS -->
            </div>
            <div class="modal-footer">
                <a id="downloadBtnAdmin" href="#" target="_blank" class="btn btn-primary">
                    <i class="fas fa-download mr-1"></i> Download File
                </a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openPreviewAdmin(url, type) {
        let container = document.getElementById('previewContainerAdmin');
        let downloadBtn = document.getElementById('downloadBtnAdmin');
        downloadBtn.href = url;

        if (['jpg', 'jpeg', 'png'].includes(type)) {
            container.innerHTML = `<img src="${url}" class="img-fluid rounded" alt="Preview Gambar">`;
        } else if (type === 'pdf') {
            container.innerHTML = `<iframe src="${url}" style="width: 100%; height: 60vh; border: none; border-radius: 8px;"></iframe>`;
        }

        $('#modalPreviewAdmin').modal('show');
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/admin_arsip_absensi.blade.php ENDPATH**/ ?>