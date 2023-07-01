<div id="loading">
    <?php echo $__env->make('partials._body_loader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>


<div id="remoteModelData" class="modal fade" role="dialog"></div>

    <?php echo e($slot); ?>



<?php echo $__env->make('partials._body_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('partials._scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials._dynamic_script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/partials/_databody.blade.php ENDPATH**/ ?>