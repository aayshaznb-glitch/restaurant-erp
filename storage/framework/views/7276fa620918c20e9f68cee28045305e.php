<?php $__env->startSection('title', 'Add Supplier'); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Add Supplier</h5>
    <form method="POST" action="<?php echo e(route('suppliers.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label">Supplier Name</label>
            <input type="text" name="supplier_name" class="form-control" value="<?php echo e(old('supplier_name')); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo e(old('address')); ?>">
        </div>
        <button class="btn btn-danger">Save Supplier</button>
        <a href="<?php echo e(route('suppliers.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/suppliers/create.blade.php ENDPATH**/ ?>