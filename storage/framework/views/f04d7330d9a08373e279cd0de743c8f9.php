<?php $__env->startSection('title', 'Kitchen Queue'); ?>

<?php $__env->startSection('content'); ?>
<h5 class="mb-3">Kitchen Order Queue</h5>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card stat-card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Order #<?php echo e($order->id); ?> — <?php echo e($order->table->table_number ?? '—'); ?></span>
                <span class="badge <?php echo e($order->statusBadgeClass()); ?>"><?php echo e(ucfirst($order->order_status)); ?></span>
            </div>
            <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <span><?php echo e($item->quantity); ?>x <?php echo e($item->menuItem->item_name ?? '—'); ?></span>
                    <form action="<?php echo e(route('kitchen.updateItemStatus', $item)); ?>" method="POST" class="d-flex align-items-center gap-1">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <select name="kitchen_status" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="pending" <?php if($item->kitchen_status === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                            <option value="preparing" <?php if($item->kitchen_status === 'preparing'): echo 'selected'; endif; ?>>Preparing</option>
                            <option value="ready" <?php if($item->kitchen_status === 'ready'): echo 'selected'; endif; ?>>Ready</option>
                        </select>
                    </form>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if($order->special_instructions): ?>
            <div class="card-footer bg-white small text-warning-emphasis">
                <i class="bi bi-info-circle"></i> <?php echo e($order->special_instructions); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12 text-center text-secondary py-5">
        <i class="bi bi-emoji-smile fs-1 d-block mb-2"></i>
        No active orders in the kitchen right now.
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/kitchen/index.blade.php ENDPATH**/ ?>