<?php $__env->startSection('title', 'Orders'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Orders</h5>
    <a href="<?php echo e(route('orders.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> New Order</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-8 col-sm-4 col-md-3">
        <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            <?php $__currentLoopData = ['pending','confirmed','preparing','ready','served','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status); ?>" <?php if(request('status') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</form>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Table</th><th>Waiter</th><th>Status</th><th>Total</th><th>Date</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($order->id); ?></td>
                    <td><?php echo e($order->table->table_number ?? '—'); ?></td>
                    <td><?php echo e($order->waiter->name ?? '—'); ?></td>
                    <td><span class="badge <?php echo e($order->statusBadgeClass()); ?>"><?php echo e(ucfirst($order->order_status)); ?></span></td>
                    <td>Rs.<?php echo e(number_format($order->total_amount, 2)); ?></td>
                    <td><?php echo e($order->order_date->format('d M, H:i')); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('orders.show', $order)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" class="text-center text-secondary py-3">No orders found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3"><?php echo e($orders->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/orders/index.blade.php ENDPATH**/ ?>