<?php $__env->startSection('title', 'Payments'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Payments</h5>
    <a href="<?php echo e(route('payments.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> New Invoice</a>
</div>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Invoice #</th><th>Order</th><th>Table</th><th>Method</th><th>Amount</th><th>Cashier</th><th>Date</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($payment->id); ?></td>
                    <td>#<?php echo e($payment->order_id); ?></td>
                    <td><?php echo e($payment->order->table->table_number ?? '—'); ?></td>
                    <td><?php echo e(ucfirst($payment->payment_method)); ?></td>
                    <td>Rs.<?php echo e(number_format($payment->amount, 2)); ?></td>
                    <td><?php echo e($payment->cashier->name ?? '—'); ?></td>
                    <td><?php echo e($payment->created_at->format('d M, H:i')); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('payments.show', $payment)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-receipt"></i></a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center text-secondary py-3">No payments recorded yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3"><?php echo e($payments->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/payments/index.blade.php ENDPATH**/ ?>