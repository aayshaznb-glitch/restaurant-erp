<?php $__env->startSection('title', 'Edit Ingredient'); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4" style="max-width:550px;">
    <h5 class="mb-3">Edit Ingredient</h5>
    <form method="POST" action="<?php echo e(route('inventory.update', ['inventory' => $inventoryItem->id])); ?>">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label class="form-label">Item Name</label>
            <input type="text" name="item_name" class="form-control" value="<?php echo e(old('item_name', $inventoryItem->item_name)); ?>" required>
        </div>
        <div class="row g-2">
            <div class="col-6">
                <label class="form-label">Quantity</label>
                <input type="number" step="0.01" min="0" name="quantity" class="form-control" value="<?php echo e(old('quantity', $inventoryItem->quantity)); ?>" required>
            </div>
            <div class="col-6">
                <label class="form-label">Unit</label>
                <input type="text" name="unit" class="form-control" value="<?php echo e(old('unit', $inventoryItem->unit)); ?>" required>
            </div>
        </div>
        <div class="mb-3 mt-3">
            <label class="form-label">Low Stock Threshold</label>
            <input type="number" step="0.01" min="0" name="low_stock_threshold" class="form-control" value="<?php echo e(old('low_stock_threshold', $inventoryItem->low_stock_threshold)); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select">
                <option value="">None</option>
                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($supplier->id); ?>" <?php if(old('supplier_id', $inventoryItem->supplier_id) == $supplier->id): echo 'selected'; endif; ?>><?php echo e($supplier->supplier_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <button class="btn btn-danger">Update Ingredient</button>
        <a href="<?php echo e(route('inventory.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/inventory/edit.blade.php ENDPATH**/ ?>