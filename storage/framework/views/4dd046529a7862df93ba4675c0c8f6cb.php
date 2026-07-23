<?php $__env->startSection('title', 'Suppliers'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Suppliers</h5>
    <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Supplier</a>
</div>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Supplier</th><th>Phone</th><th>Address</th><th>Ingredients Supplied</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($supplier->supplier_name); ?></td>
                    <td><?php echo e($supplier->phone ?? '—'); ?></td>
                    <td><?php echo e($supplier->address ?? '—'); ?></td>
                    <td><?php echo e($supplier->inventory_items_count); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="<?php echo e(route('suppliers.destroy', $supplier)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this supplier?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center text-secondary py-3">No suppliers yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3"><?php echo e($suppliers->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/suppliers/index.blade.php ENDPATH**/ ?>