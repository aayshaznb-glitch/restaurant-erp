<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Customers</h5>
    <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Customer</a>
</div>

<form method="GET" class="mb-3">
    <input type="text" name="search" class="form-control" style="max-width:300px;" placeholder="Search by name..." value="<?php echo e(request('search')); ?>">
</form>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr><th>Name</th><th>Phone</th><th>Email</th><th>Orders</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($customer->name); ?></td>
                    <td><?php echo e($customer->phone ?? '—'); ?></td>
                    <td><?php echo e($customer->email ?? '—'); ?></td>
                    <td><?php echo e($customer->orders_count); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(route('customers.show', $customer)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></a>
                        <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="<?php echo e(route('customers.destroy', $customer)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Delete this customer?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="text-center text-secondary py-3">No customers yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3"><?php echo e($customers->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/customers/index.blade.php ENDPATH**/ ?>