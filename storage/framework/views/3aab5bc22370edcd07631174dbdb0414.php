<?php $__env->startSection('title', 'Invoice #'.$payment->id); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4 mx-auto" style="max-width:600px;">
    <div class="text-center mb-3">
        <h5 class="mb-0">Restaurant ERP</h5>
        <div class="text-secondary small">Invoice #<?php echo e($payment->id); ?></div>
    </div>
    <hr>
    <div class="d-flex justify-content-between small mb-1"><span>Order #</span><span><?php echo e($payment->order_id); ?></span></div>
    <div class="d-flex justify-content-between small mb-1"><span>Table</span><span><?php echo e($payment->order->table->table_number ?? '—'); ?></span></div>
    <div class="d-flex justify-content-between small mb-1"><span>Cashier</span><span><?php echo e($payment->cashier->name ?? '—'); ?></span></div>
    <div class="d-flex justify-content-between small mb-3"><span>Date</span><span><?php echo e($payment->created_at->format('d M Y, H:i')); ?></span></div>
    <table class="table table-sm">
        <thead><tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $payment->order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->menuItem->item_name ?? '—'); ?></td>
                <td><?php echo e($item->quantity); ?></td>
                <td>Rs.<?php echo e(number_format($item->price, 2)); ?></td>
                <td>Rs.<?php echo e(number_format($item->subtotal(), 2)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between small"><span>Subtotal</span><span>Rs.<?php echo e(number_format($payment->order->total_amount, 2)); ?></span></div>
    <div class="d-flex justify-content-between small"><span>Discount</span><span>-Rs.<?php echo e(number_format($payment->discount, 2)); ?></span></div>
    <div class="d-flex justify-content-between fs-5 fw-bold border-top pt-2 mt-2">
        <span>Total Paid</span><span>Rs.<?php echo e(number_format($payment->amount, 2)); ?></span>
    </div>
    <div class="text-center mt-3">
        <span class="badge bg-secondary"><?php echo e(ucfirst($payment->payment_method)); ?></span>
        <span class="badge bg-success"><?php echo e(ucfirst($payment->payment_status)); ?></span>
    </div>
    <button class="btn btn-outline-secondary mt-3 d-print-none" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/payments/show.blade.php ENDPATH**/ ?>