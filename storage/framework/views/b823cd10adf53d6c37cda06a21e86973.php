<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-3">
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Today's Orders</div>
            <div class="fs-3 fw-bold"><?php echo e($todaysOrders); ?></div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Pending Orders</div>
            <div class="fs-3 fw-bold text-warning"><?php echo e($pendingOrders); ?></div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Available Tables</div>
            <div class="fs-3 fw-bold text-success"><?php echo e($availableTables); ?> / <?php echo e($totalTables); ?></div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Menu Items</div>
            <div class="fs-3 fw-bold"><?php echo e($totalMenuItems); ?></div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Low Stock Ingredients</div>
            <div class="fs-3 fw-bold text-danger"><?php echo e($lowStockCount); ?></div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Today's Sales</div>
            <div class="fs-3 fw-bold">Rs.<?php echo e(number_format($todaysSales, 2)); ?></div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card p-3 h-100">
            <div class="text-secondary small">Monthly Revenue</div>
            <div class="fs-3 fw-bold text-primary">Rs.<?php echo e(number_format($monthlyRevenue, 2)); ?></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-7">
        <div class="card stat-card h-100">
            <div class="card-header bg-white fw-semibold">Recent Orders</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr><th>#</th><th>Table</th><th>Waiter</th><th>Status</th><th>Total</th></tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->table->table_number ?? '—'); ?></td>
                            <td><?php echo e($order->waiter->name ?? '—'); ?></td>
                            <td><span class="badge <?php echo e($order->statusBadgeClass()); ?>"><?php echo e(ucfirst($order->order_status)); ?></span></td>
                            <td>Rs.<?php echo e(number_format($order->total_amount, 2)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center text-secondary py-3">No orders yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-5">
        <div class="card stat-card h-100">
            <div class="card-header bg-white fw-semibold">Low Stock Alerts</div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo e($item->item_name); ?>

                    <span class="badge bg-danger"><?php echo e($item->quantity); ?> <?php echo e($item->unit); ?></span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item text-secondary text-center">All ingredients well stocked.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/dashboard.blade.php ENDPATH**/ ?>