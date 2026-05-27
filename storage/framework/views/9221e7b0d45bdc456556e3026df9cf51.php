<div class="card mb-3">

  <div class="card-header d-flex justify-content-between align-items-center">
    <h3 class="card-title mb-0"><?php echo e($title); ?></h3>

    <?php if(isset($collapse)): ?>
      <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#cardBody<?php echo e($id ?? 'default'); ?>">
        <i class="fas fa-plus"></i>
      </button>
    <?php endif; ?>
  </div>

  <div id="cardBody<?php echo e($id ?? 'default'); ?>" class="<?php echo e(isset($collapse) ? 'collapse' : ''); ?>">
    <div class="card-body">
      <?php echo e($slot); ?>

    </div>
  </div>

</div><?php /**PATH C:\laragon\www\bimbel-mentari\resources\views/components/card.blade.php ENDPATH**/ ?>