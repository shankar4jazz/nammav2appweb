<div class="page-title-wrap mb-3 p-3">
    <h2 class="page-title"><?php echo e(__('Jobs Details')); ?></h2>
</div>
<div class="mb-3 ms-2">
    <ul class="nav nav--tabs nav--tabs__style2 provider-detail-tab">
        <li class="nav-item <?php echo e(request()->routeIs('jobs.show') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('jobs.show',$providerdata->id)); ?>"> <?php echo e(__('messages.overview')); ?></a>
        </li>
        <li class="nav-item <?php echo e(request()->routeIs('payment.details') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('payment.details',$providerdata->id)); ?>"> <?php echo e(__('Payment Details')); ?></a>
        </li>
        <li class="nav-item <?php echo e(request()->routeIs('applicant.details') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('applicant.details',$providerdata->id)); ?>"> <?php echo e(__('Application Lists')); ?></a>
        </li>
    </ul>
</div><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/partials/_jobs.blade.php ENDPATH**/ ?>