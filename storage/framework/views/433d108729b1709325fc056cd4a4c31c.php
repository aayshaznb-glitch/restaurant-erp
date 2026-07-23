<?php $__env->startSection('title', 'New Order'); ?>

<?php $__env->startSection('content'); ?>
<div class="card stat-card p-4">
    <h5 class="mb-3">Create New Order</h5>
    <form method="POST" action="<?php echo e(route('orders.store')); ?>" id="orderForm">
        <?php echo csrf_field(); ?>
        <div class="row g-3 mb-3">
            <div class="col-12 col-md-4">
                <label class="form-label">Table</label>
                <select name="table_id" class="form-select" required>
                    <option value="">Select table</option>
                    <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($table->id); ?>"><?php echo e($table->table_number); ?> (<?php echo e($table->capacity); ?> seats)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label">Customer (optional)</label>
                <select name="customer_id" class="form-select">
                    <option value="">Walk-in</option>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->id); ?>"><?php echo e($customer->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label">Special Instructions</label>
                <input type="text" name="special_instructions" class="form-control" placeholder="e.g. no onions">
            </div>
        </div>

        <hr>
        <h6>Order Items</h6>
        <div id="itemRows"></div>
        <button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="addRow"><i class="bi bi-plus-lg"></i> Add Item</button>

        <div class="text-end fs-5 fw-bold mb-3">Total: Rs.<span id="grandTotal">0.00</span></div>

        <button class="btn btn-danger">Send Order to Kitchen</button>
        <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const menuItems = <?php echo json_encode($menuItems->map(fn($m) => ['id' => $m->id, 'name' => $m->item_name, 'price' => $m->price])) ?>;
    let rowCount = 0;

    function addRow() {
        const idx = rowCount++;
        const options = menuItems.map(m => `<option value="${m.id}" data-price="${m.price}">${m.name} - $${Number(m.price).toFixed(2)}</option>`).join('');
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-center mb-2 item-row';
        row.innerHTML = `
            <div class="col-6 col-md-6">
                <select name="items[${idx}][menu_item_id]" class="form-select item-select" required>
                    <option value="">Select item</option>
                    ${options}
                </select>
            </div>
            <div class="col-3 col-md-2">
                <input type="number" name="items[${idx}][quantity]" class="form-control item-qty" value="1" min="1" required>
            </div>
            <div class="col-2 col-md-2 text-end line-total">$0.00</div>
            <div class="col-1 col-md-2 text-end">
                <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="bi bi-x-lg"></i></button>
            </div>
        `;
        document.getElementById('itemRows').appendChild(row);
        attachRowEvents(row);
    }

    function attachRowEvents(row) {
        const select = row.querySelector('.item-select');
        const qty = row.querySelector('.item-qty');
        const lineTotal = row.querySelector('.line-total');
        const removeBtn = row.querySelector('.remove-row');

        function updateLine() {
            const opt = select.options[select.selectedIndex];
            const price = opt ? parseFloat(opt.dataset.price || 0) : 0;
            const total = price * (parseFloat(qty.value) || 0);
            lineTotal.textContent = '$' + total.toFixed(2);
            updateGrandTotal();
        }

        select.addEventListener('change', updateLine);
        qty.addEventListener('input', updateLine);
        removeBtn.addEventListener('click', () => { row.remove(); updateGrandTotal(); });
    }

    function updateGrandTotal() {
        let sum = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const select = row.querySelector('.item-select');
            const qty = row.querySelector('.item-qty');
            const opt = select.options[select.selectedIndex];
            const price = opt ? parseFloat(opt.dataset.price || 0) : 0;
            sum += price * (parseFloat(qty.value) || 0);
        });
        document.getElementById('grandTotal').textContent = sum.toFixed(2);
    }

    document.getElementById('addRow').addEventListener('click', addRow);
    addRow(); // start with one row
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/orders/create.blade.php ENDPATH**/ ?>