<?php $__env->startSection('title', 'New Invoice'); ?>

<?php $__env->startSection('content'); ?>
<h5 class="mb-3">Orders Ready for Billing</h5>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card stat-card p-3 h-100">
            <div class="d-flex justify-content-between">
                <span class="fw-semibold">Order #<?php echo e($order->id); ?></span>
                <span class="badge <?php echo e($order->statusBadgeClass()); ?>"><?php echo e(ucfirst($order->order_status)); ?></span>
            </div>
            <div class="text-secondary small mb-2">Table <?php echo e($order->table->table_number ?? '—'); ?> · <?php echo e($order->items->count()); ?> items</div>
            <div class="fw-bold mb-2">Rs.<?php echo e(number_format($order->total_amount, 2)); ?></div>
            <a href="<?php echo e(route('payments.bill', $order)); ?>" class="btn btn-danger btn-sm">Generate Bill</a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12 text-center text-secondary py-4">No orders awaiting payment.</div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/payments/create.blade.php ENDPATH**/ ?>