<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
    <h5 class="mb-3 text-center">Sign in to your account</h5>
    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-danger w-100">Login</button>
    </form>
   
    <hr>
    <p class="small text-muted mb-0">Demo accounts (password: <code>password</code>):</p>
    <ul class="small text-muted mb-0">
        <li>admin@restaurant.test</li>
        <li>manager@restaurant.test</li>
        <li>waiter@restaurant.test</li>
        <li>kitchen@restaurant.test</li>
        <li>cashier@restaurant.test</li>
    </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\MSI PC\Documents\Project Order\+94 75 742 5819_Ayesha\restaurant-erp\resources\views/auth/login.blade.php ENDPATH**/ ?>