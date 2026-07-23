<?php $__env->startSection('title', 'Add Customer'); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Add Customer</h5>
    <form method="POST" action="<?php echo e(route('customers.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone')); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Feedback</label>
            <textarea name="feedback" class="form-control" rows="2"><?php echo e(old('feedback')); ?></textarea>
        </div>
        <button class="btn btn-danger">Save Customer</button>
        <a href="<?php echo e(route('customers.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/customers/create.blade.php ENDPATH**/ ?>