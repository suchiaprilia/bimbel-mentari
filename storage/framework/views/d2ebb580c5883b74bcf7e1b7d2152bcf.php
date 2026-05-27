<?php $__env->startSection('judul', 'Riwayat Notifikasi WhatsApp'); ?>

<?php $__env->startSection('konten'); ?>

<div class="row">
    <div class="col-md-12">
        <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Daftar Notifikasi']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Daftar Notifikasi']); ?>
            
            <div class="d-flex justify-content-between mb-4 flex-wrap">
                
                <form action="<?php echo e(route('notifikasi.index')); ?>" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari pesan atau nomor..." value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    <?php if(request('search')): ?>
                        <a href="<?php echo e(route('notifikasi.index')); ?>" class="btn btn-secondary btn-sm">Reset</a>
                    <?php endif; ?>
                </form>

                
                <form action="<?php echo e(route('notifikasi.clear')); ?>" method="POST" onsubmit="return confirm('Hapus semua riwayat notifikasi?')">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash-can"></i> Hapus Semua Log
                    </button>
                </form>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Penerima</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th>Waktu Kirim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $notifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e(($notifikasi->currentPage() - 1) * $notifikasi->perPage() + $loop->iteration); ?></td>
                            <td>
                                <?php if($n->pembayaran && $n->pembayaran->siswa): ?>
                                    <span class="d-block font-weight-bold"><?php echo e($n->pembayaran->siswa->nama_siswa); ?></span>
                                <?php else: ?>
                                    <span class="d-block font-weight-bold text-muted">Siswa/Pendaftar</span>
                                <?php endif; ?>
                                <small class="text-muted"><?php echo e($n->target_phone ?? '-'); ?></small>
                                <br>
                                <span class="badge badge-light" style="font-size: 10px;"><?php echo e(strtoupper($n->type ?? 'umum')); ?></span>
                            </td>
                            <td>
                                <div style="max-width: 400px; white-space: pre-wrap; font-size: 13px;"><?php echo e($n->pesan); ?></div>
                            </td>
                            <td>
                                <?php
                                    $status = $n->status_kirim ?? 'Terkirim';
                                    $badgeClass = $status == 'Terkirim' ? 'badge-success' : 'badge-danger';
                                ?>
                                <span class="badge <?php echo e($badgeClass); ?>">
                                    <?php echo e($status); ?>

                                </span>
                            </td>
                            <td>
                                <small class="text-muted d-block"><?php echo e(\Carbon\Carbon::parse($n->waktu_kirim)->format('d M Y')); ?></small>
                                <small class="text-muted"><?php echo e(\Carbon\Carbon::parse($n->waktu_kirim)->format('H:i')); ?> WIB</small>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="fa-solid fa-bell-slash fa-3x mb-3 opacity-20"></i>
                                <p>Belum ada riwayat notifikasi terkirim.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <?php echo e($notifikasi->links()); ?>

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
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/notifikasi.blade.php ENDPATH**/ ?>