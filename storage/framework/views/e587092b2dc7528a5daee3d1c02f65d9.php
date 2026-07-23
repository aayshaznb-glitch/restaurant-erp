<?php $__env->startSection('title', 'Reports'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" class="mb-3">
    <select name="range" class="form-select" style="max-width:220px;" onchange="this.form.submit()">
        <option value="daily" <?php if($range === 'daily'): echo 'selected'; endif; ?>>Today</option>
        <option value="weekly" <?php if($range === 'weekly'): echo 'selected'; endif; ?>>Last 7 Days</option>
        <option value="monthly" <?php if($range === 'monthly'): echo 'selected'; endif; ?>>This Month</option>
    </select>
</form>

<div class="row g-3 mb-3">
    <div class="col-12 col-md-4">
        <div class="card stat-card p-3">
            <div class="text-secondary small">Sales Total</div>
            <div class="fs-3 fw-bold text-success">Rs.<?php echo e(number_format($salesTotal, 2)); ?></div>
        </div>
    </div>
    <div class="col-12 col-md-8">
        <div class="card stat-card p-3">
            <div class="text-secondary small mb-2">Orders by Status</div>
            <div class="d-flex flex-wrap gap-2">
                <?php $__empty_1 = true; $__currentLoopData = $ordersByStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <span class="badge bg-secondary"><?php echo e(ucfirst($status)); ?>: <?php echo e($count); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <span class="text-secondary small">No order data yet.</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-12 col-lg-6">
        <div class="card stat-card">
            <div class="card-header bg-white fw-semibold">Most Popular Menu Items</div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $popularItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?php echo e($row->menuItem->item_name ?? 'Unknown item'); ?>

                    <span class="badge bg-primary"><?php echo e($row->total_sold); ?> sold</span>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item text-secondary text-center">No sales data yet.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card stat-card">
            <div class="card-header bg-white fw-semibold">Low Stock Items</div>
            <ul class="list-group list-group-flush">
                <?php $__empty_1 = true; $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item d-flex justify-content-between">
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

<div class="card stat-card mt-3">
    <div class="card-header bg-white fw-semibold">Daily Sales (Last 7 Days)</div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead class="table-light"><tr><th>Date</th><th>Sales</th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $dailySales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr><td><?php echo e(\Carbon\Carbon::parse($row->day)->format('d M Y')); ?></td><td>Rs.<?php echo e(number_format($row->total, 2)); ?></td></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="2" class="text-center text-secondary py-3">No sales in this period.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/reports/index.blade.php ENDPATH**/ ?>