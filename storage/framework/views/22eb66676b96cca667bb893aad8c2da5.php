<?php $__env->startSection('title', 'Edit Menu Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4" style="max-width:600px;">
    <h5 class="mb-3">Edit Menu Item</h5>
    <form method="POST" action="<?php echo e(route('menu-items.update', $menuItem)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select" required>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if(old('category_id', $menuItem->category_id) == $category->id): echo 'selected'; endif; ?>><?php echo e($category->category_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" value="<?php echo e(old('item_name', $menuItem->item_name)); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2"><?php echo e(old('description', $menuItem->description)); ?></textarea>
        </div>
        <div class="row g-2">
            <div class="col-6">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" min="0" name="price" class="form-control" value="<?php echo e(old('price', $menuItem->price)); ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="available" <?php if($menuItem->status === 'available'): echo 'selected'; endif; ?>>Available</option>
                    <option value="unavailable" <?php if($menuItem->status === 'unavailable'): echo 'selected'; endif; ?>>Unavailable</option>
                </select>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <?php if($menuItem->image): ?>
                <img src="<?php echo e(asset('storage/'.$menuItem->image)); ?>" style="height:80px;" class="rounded mb-2 d-block">
            <?php endif; ?>
            <label class="form-label">Replace Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <button class="btn btn-danger">Update Item</button>
        <a href="<?php echo e(route('menu-items.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/menu_items/edit.blade.php ENDPATH**/ ?>