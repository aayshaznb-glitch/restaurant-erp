<?php $__env->startSection('title', 'Tables'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Restaurant Tables</h5>
    <a href="<?php echo e(route('tables.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Table</a>
</div>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $statusColors = ['available' => 'success', 'reserved' => 'info', 'occupied' => 'danger', 'cleaning' => 'warning'];
    ?>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100 text-center">
            <div class="fs-4 fw-bold"><?php echo e($table->table_number); ?></div>
            <div class="text-secondary small mb-2"><i class="bi bi-people"></i> <?php echo e($table->capacity); ?> seats</div>
            <span class="badge bg-<?php echo e($statusColors[$table->status]); ?> mb-2"><?php echo e(ucfirst($table->status)); ?></span>
            <form action="<?php echo e(route('tables.updateStatus', $table)); ?>" method="POST" class="mb-2">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <?php $__currentLoopData = ['available','reserved','occupied','cleaning']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php if($table->status === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </form>
            <div class="d-flex justify-content-center gap-1">
                <a href="<?php echo e(route('tables.edit', $table)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                <form action="<?php echo e(route('tables.destroy', $table)); ?>" method="POST" onsubmit="return confirm('Remove this table?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12 text-center text-secondary py-4">No tables set up yet.</div>
    <?php endif; ?>
</div>
<div class="mt-3"><?php echo e($tables->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/tables/index.blade.php ENDPATH**/ ?>