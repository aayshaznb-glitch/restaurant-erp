<?php $__env->startSection('title', 'Order #'.$order->id); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-12 col-lg-8">
        <div class="card stat-card p-4 mb-3">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <h5 class="mb-1">Order #<?php echo e($order->id); ?></h5>
                    <div class="text-secondary small"><?php echo e($order->order_date->format('d M Y, H:i')); ?></div>
                </div>
                <span class="badge fs-6 <?php echo e($order->statusBadgeClass()); ?>"><?php echo e(ucfirst($order->order_status)); ?></span>
            </div>
            <hr>
            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3"><div class="text-secondary small">Table</div><div class="fw-semibold"><?php echo e($order->table->table_number ?? '—'); ?></div></div>
                <div class="col-6 col-md-3"><div class="text-secondary small">Waiter</div><div class="fw-semibold"><?php echo e($order->waiter->name ?? '—'); ?></div></div>
                <div class="col-6 col-md-3"><div class="text-secondary small">Customer</div><div class="fw-semibold"><?php echo e($order->customer->name ?? 'Walk-in'); ?></div></div>
                <div class="col-6 col-md-3"><div class="text-secondary small">Total</div><div class="fw-semibold">$<?php echo e(number_format($order->total_amount, 2)); ?></div></div>
            </div>
            <?php if($order->special_instructions): ?>
            <div class="alert alert-warning py-2 small">Note: <?php echo e($order->special_instructions); ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th><th>Kitchen Status</th></tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->menuItem->item_name ?? '—'); ?></td>
                            <td><?php echo e($item->quantity); ?></td>
                            <td>Rs.<?php echo e(number_format($item->price, 2)); ?></td>
                            <td>Rs.<?php echo e(number_format($item->subtotal(), 2)); ?></td>
                            <td><span class="badge bg-light text-dark border"><?php echo e(ucfirst($item->kitchen_status)); ?></span></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card stat-card p-4 mb-3">
            <h6 class="mb-3">Update Status</h6>
            <form method="POST" action="<?php echo e(route('orders.updateStatus', $order)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                <select name="order_status" class="form-select mb-2">
                    <?php $__currentLoopData = ['pending','confirmed','preparing','ready','served','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php if($order->order_status === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button class="btn btn-danger w-100">Update</button>
            </form>
        </div>

        <?php if($order->payment): ?>
        <div class="card stat-card p-4">
            <h6 class="mb-2">Payment</h6>
            <div class="small text-secondary">Method: <?php echo e(ucfirst($order->payment->payment_method)); ?></div>
            <div class="small text-secondary">Amount: $<?php echo e(number_format($order->payment->amount, 2)); ?></div>
            <span class="badge bg-success mt-2">Paid</span>
        </div>
        <?php else: ?>
        <div class="card stat-card p-4 text-center text-secondary small">
            No payment recorded yet.
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/orders/show.blade.php ENDPATH**/ ?>