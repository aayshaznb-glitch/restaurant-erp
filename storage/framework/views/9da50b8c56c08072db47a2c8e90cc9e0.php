<?php $__env->startSection('title', 'Edit Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4" style="max-width:500px;">
    <h5 class="mb-3">Edit Category</h5>
    <form method="POST" action="<?php echo e(route('categories.update', $category)); ?>">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" value="<?php echo e(old('category_name', $category->category_name)); ?>" required autofocus>
        </div>
        <button class="btn btn-danger">Update Category</button>
        <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/categories/edit.blade.php ENDPATH**/ ?>