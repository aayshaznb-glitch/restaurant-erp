<?php $__env->startSection('title', 'Menu Items'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <h5 class="mb-0">Menu Items</h5>
    <a href="<?php echo e(route('menu-items.create')); ?>" class="btn btn-danger btn-sm"><i class="bi bi-plus-lg"></i> Add Menu Item</a>
</div>

<form method="GET" class="row g-2 mb-3">
    <div class="col-12 col-sm-5 col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Search item name..." value="<?php echo e(request('search')); ?>">
    </div>
    <div class="col-8 col-sm-4 col-md-3">
        <select name="category_id" class="form-select">
            <option value="">All Categories</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($category->id); ?>" <?php if(request('category_id') == $category->id): echo 'selected'; endif; ?>><?php echo e($category->category_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    <div class="col-4 col-sm-3 col-md-2">
        <button class="btn btn-outline-secondary w-100"><i class="bi bi-filter"></i> Filter</button>
    </div>
</form>

<div class="row g-3">
    <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-6 col-md-4 col-xl-3">
        <div class="card stat-card h-100">
            <div class="ratio ratio-4x3 bg-light d-flex align-items-center justify-content-center">
                <?php if($item->image): ?>
                    <img src="<?php echo e(asset('storage/'.$item->image)); ?>" class="w-100 h-100" style="object-fit:cover;">
                <?php else: ?>
                    <i class="bi bi-egg-fried fs-1 text-secondary"></i>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                    <span class="fw-semibold flex-fill text-truncate" style="min-width: 0;"><?php echo e($item->item_name); ?></span>
                    <span class="badge <?php echo e($item->status === 'available' ? 'bg-success' : 'bg-secondary'); ?>"><?php echo e(ucfirst($item->status)); ?></span>
                </div>
                <div class="text-secondary small"><?php echo e($item->category->category_name ?? '—'); ?></div>
                <div class="fw-bold mt-1">Rs.<?php echo e(number_format($item->price, 2)); ?></div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-end gap-1">
                <a href="<?php echo e(route('menu-items.edit', $item)); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                <form action="<?php echo e(route('menu-items.destroy', $item)); ?>" method="POST" onsubmit="return confirm('Delete this item?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-12 text-center text-secondary py-4">No menu items found.</div>
    <?php endif; ?>
</div>
<div class="mt-3"><?php echo e($menuItems->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/menu_items/index.blade.php ENDPATH**/ ?>