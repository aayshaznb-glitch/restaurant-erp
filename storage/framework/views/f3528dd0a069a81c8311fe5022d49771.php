<?php $__env->startSection('title', 'Generate Bill'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card stat-card p-4">
            <h5 class="mb-3">Order #<?php echo e($order->id); ?> — Table <?php echo e($order->table->table_number ?? '—'); ?></h5>
            <table class="table align-middle">
                <thead class="table-light"><tr><th>Item</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr></thead>
                <tbody>
                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->menuItem->item_name ?? '—'); ?></td>
                        <td><?php echo e($item->quantity); ?></td>
                        <td>Rs.<?php echo e(number_format($item->price, 2)); ?></td>
                        <td>Rs.<?php echo e(number_format($item->subtotal(), 2)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="text-end fs-5 fw-bold">Order Total: Rs.<?php echo e(number_format($order->total_amount, 2)); ?></div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="card stat-card p-4">
            <h6 class="mb-3">Payment Details</h6>
            <form method="POST" action="<?php echo e(route('payments.store')); ?>">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="order_id" value="<?php echo e($order->id); ?>">
                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="cash">Cash</option>
                        <option value="card">Card</option>
                        <option value="online">Online Payment</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Discount ($)</label>
                    <input type="number" step="0.01" min="0" name="discount" id="discountInput" class="form-control" value="0">
                </div>
                <div class="d-flex justify-content-between fs-5 fw-bold mb-3">
                    <span>Payable:</span>
                    <span>Rs.<span id="payableAmount"><?php echo e(number_format($order->total_amount, 2)); ?></span></span>
                </div>
                <button class="btn btn-danger w-100">Confirm Payment</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const orderTotal = <?php echo e($order->total_amount); ?>;
    const discountInput = document.getElementById('discountInput');
    const payableEl = document.getElementById('payableAmount');
    discountInput.addEventListener('input', () => {
        const discount = parseFloat(discountInput.value) || 0;
        payableEl.textContent = Math.max(orderTotal - discount, 0).toFixed(2);
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/payments/bill.blade.php ENDPATH**/ ?>