<?php $__env->startSection('title', 'Inventory'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Inventory</h5>
    <a href="<?php echo e(route('inventory.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Ingredient</a>
</div>

<form method="GET" class="mb-3">
    <div class="form-check">
        <input type="checkbox" name="low_stock" value="1" class="form-check-input" id="lowStock" onchange="this.form.submit()" <?php if(request('low_stock')): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="lowStock">Show low stock only</label>
    </div>
</form>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Ingredient</th><th>Quantity</th><th>Supplier</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item->item_name); ?></td>
                    <td><?php echo e($item->quantity); ?> <?php echo e($item->unit); ?></td>
                    <td><?php echo e($item->supplier->supplier_name ?? '—'); ?></td>
                    <td>
                        <?php if($item->stock_status === 'low'): ?>
                            <span class="badge bg-danger">Low Stock</span>
                        <?php else: ?>
                            <span class="badge bg-success">OK</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="<?php echo e(route('inventory.edit', $item->id)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="<?php echo e(route('inventory.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Remove this ingredient?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center text-secondary py-3">No inventory items yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3"><?php echo e($items->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/inventory/index.blade.php ENDPATH**/ ?>