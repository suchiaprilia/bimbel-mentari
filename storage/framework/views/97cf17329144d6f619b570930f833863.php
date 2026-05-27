<?php ($editJadwal = $editJadwal ?? null); ?>

<?php $__env->startSection('judul', 'Data Jadwal'); ?>

<?php $__env->startSection('konten'); ?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<style>
.bootstrap-select .dropdown-menu { max-height: 300px !important; }
.bootstrap-select .dropdown-item { padding: 8px 15px; }
</style>


<?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => ''.e($editJadwal ? 'Edit Jadwal' : 'Tambah Jadwal').'','collapse' => 'true','id' => 'formJadwal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($editJadwal ? 'Edit Jadwal' : 'Tambah Jadwal').'','collapse' => 'true','id' => 'formJadwal']); ?>

<form 
    action="<?php echo e($editJadwal ? route('jadwal.update', $editJadwal->id_jadwal) : route('jadwal.store')); ?>" 
    method="POST"
    class="form-crud"
>

    <?php echo csrf_field(); ?>

    <?php if($editJadwal): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <div class="row">

        
        <div class="col-md-4">
            <div class="form-group">

                <label>Guru</label>

                <select 
                    name="id_guru"
                    id="id_guru"
                    class="form-control"
                    required
                >

                    <option value="">-- Pilih Guru --</option>

                    <?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option 
                            value="<?php echo e($g->id); ?>"
                            data-mapel-id="<?php echo e($g->id_mapel); ?>"
                            data-mapel="<?php echo e($g->mapel->nama_mapel ?? '-'); ?>"
                            <?php echo e(old('id_guru', $editJadwal->id_guru ?? '') == $g->id ? 'selected' : ''); ?>

                        >

                            <?php echo e($g->nama_guru); ?>


                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            </div>
        </div>


        
        <div class="col-md-4">
            <div class="form-group">

                <label>Kelas</label>

                <select 
                    name="id_kelas"
                    id="id_kelas"
                    class="form-control"
                    required
                >

                    <option value="">-- Pilih Kelas --</option>

                    <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option 
                            value="<?php echo e($k->id); ?>"
                            <?php echo e(old('id_kelas', $editJadwal->id_kelas ?? '') == $k->id ? 'selected' : ''); ?>

                        >

                            <?php echo e($k->nama_kelas); ?>


                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            </div>
        </div>


        
        <div class="col-md-4">
            <div class="form-group">

                <label>Mata Pelajaran</label>

                <input 
                    type="text"
                    id="nama_mapel"
                    class="form-control"
                    readonly
                    value="<?php echo e($editJadwal->mapel->nama_mapel ?? ''); ?>"
                >

                
                <input 
                    type="hidden"
                    name="id_mapel"
                    id="id_mapel"
                    value="<?php echo e(old('id_mapel', $editJadwal->id_mapel ?? '')); ?>"
                >

            </div>
        </div>


        
        <div class="col-md-12">

            <div class="form-group">

                <label>Pilih Siswa</label>

                <select 
                    name="siswa_id[]"
                    id="siswaDropdown"
                    class="form-control selectpicker"
                    data-live-search="true"
                    data-actions-box="true"
                    data-container="body"
                    title="-- Pilih Siswa --"
                    data-selected-text-format="count > 2"
                    multiple
                    required
                >

                    <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option 
                            value="<?php echo e($s->id); ?>"
                            data-kelas="<?php echo e($s->id_kelas); ?>"
                            data-mapel="<?php echo e($s->mapels->pluck('id_mapel')->implode(',')); ?>"

                            <?php if($editJadwal): ?>

                                <?php echo e(in_array(
                                    $s->id,
                                    $editJadwal->siswa->pluck('id')->toArray()
                                ) ? 'selected' : ''); ?>


                            <?php endif; ?>
                        >

                            <?php echo e($s->nama_siswa); ?>


                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

                <small class="text-muted">
                    Siswa otomatis tampil sesuai kelas dan mapel
                </small>

            </div>

        </div>


        
        <div class="col-md-4">
            <div class="form-group">

                <label>Tanggal</label>

                <input 
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="<?php echo e(old('tanggal', $editJadwal->tanggal ?? '')); ?>"
                    required
                >

            </div>
        </div>


        
        <div class="col-md-4">
            <div class="form-group">

                <label>Jam Mulai</label>

                <input 
                    type="time"
                    name="jam_mulai"
                    class="form-control"
                    value="<?php echo e(old('jam_mulai', $editJadwal->jam_mulai ?? '')); ?>"
                    required
                >

            </div>
        </div>


        
        <div class="col-md-4">
            <div class="form-group">

                <label>Jam Selesai</label>

                <input 
                    type="time"
                    name="jam_selesai"
                    class="form-control"
                    value="<?php echo e(old('jam_selesai', $editJadwal->jam_selesai ?? '')); ?>"
                    required
                >

            </div>
        </div>

    </div>


    <div class="mt-3 text-right">

        <button type="submit" class="btn btn-success btn-sm">
            <?php echo e($editJadwal ? 'Update' : 'Simpan'); ?>

        </button>

        <a href="<?php echo e(route('jadwal.index')); ?>" class="btn btn-secondary btn-sm">
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Data Jadwal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Jadwal']); ?>

<div class="table-responsive">

<table class="table table-bordered table-hover">

    <thead class="bg-light">

        <tr>

            <th>No</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Kelas</th>
            <th>Mapel</th>
            <th>Guru</th>
            <th>Siswa</th>
            <th width="80">Aksi</th>

        </tr>

    </thead>

    <tbody>

        <?php $__empty_1 = true; $__currentLoopData = $jadwal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <tr>

            <td><?php echo e($loop->iteration); ?></td>

            <td><?php echo e($row->tanggal); ?></td>

            <td>
                <?php echo e($row->jam_mulai); ?> - <?php echo e($row->jam_selesai); ?>

            </td>

            <td>
                <?php echo e($row->kelas->nama_kelas ?? '-'); ?>

            </td>

            <td>
                <?php echo e($row->mapel->nama_mapel ?? '-'); ?>

            </td>

            <td>
                <?php echo e($row->guru->nama_guru ?? '-'); ?>

            </td>

            <td>

                <?php $__empty_2 = true; $__currentLoopData = $row->siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>

                    <span class="badge badge-info">
                        <?php echo e($s->nama_siswa); ?>

                    </span>
                    <br>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>

                    <span class="text-muted">
                        Tidak ada siswa
                    </span>

                <?php endif; ?>

            </td>

            <td class="text-center">

                <div class="dropdown">

                    <button type="button"
                            class="btn btn-light btn-sm"
                            data-toggle="dropdown">

                        ⋮

                    </button>

                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="<?php echo e(route('jadwal.edit', $row->id_jadwal)); ?>"
                           class="dropdown-item">

                            ✏ Edit

                        </a>

                        <form 
                            action="<?php echo e(route('jadwal.destroy', $row->id_jadwal)); ?>"
                            method="POST"
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

            <td colspan="8" class="text-center text-muted">
                Belum ada data jadwal
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
    const namaMapel = document.getElementById('nama_mapel');
    const idMapel = document.getElementById('id_mapel');

    function tampilMapel() {

        const selected = guru.options[guru.selectedIndex];

        namaMapel.value =
            selected.getAttribute('data-mapel') || '';

        idMapel.value =
            selected.getAttribute('data-mapel-id') || '';

        filterSiswa();

    }

    guru.addEventListener('change', tampilMapel);

    tampilMapel();

});


function filterSiswa() {

    let kelas = document.getElementById('id_kelas').value;
    let mapel = document.getElementById('id_mapel').value;

    let siswa = document.querySelectorAll('#siswaDropdown option');

    siswa.forEach(function(item){

        let kelasSiswa = item.getAttribute('data-kelas');
        let mapelSiswa = item.getAttribute('data-mapel');

        let mapelArray = mapelSiswa.split(',');

        if(kelasSiswa == kelas && mapelArray.includes(mapel)) {

            item.disabled = false;
            item.hidden = false;
            $(item).show();

        } else {

            item.disabled = true;
            item.hidden = true;
            item.selected = false;
            $(item).hide();

        }

    });

    if($.fn.selectpicker) {
        $('#siswaDropdown').selectpicker('refresh');
    } else {
        $('#siswaDropdown').trigger('change');
    }

}

document.getElementById('id_kelas')
    .addEventListener('change', filterSiswa);

window.onload = filterSiswa;

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
$(document).ready(function() {
    $('#siswaDropdown').selectpicker();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_modern', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/jadwal.blade.php ENDPATH**/ ?>