<div class="page-title-wrap mb-3 p-3">
    <h2 class="page-title"><?php echo e(__('Jobs Details')); ?></h2>
    <a href="<?php echo e(route('jobs.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('back jobs lists')); ?></a>
</div>
<div class="mb-3 ms-2">
    <ul class="nav nav--tabs nav--tabs__style2 provider-detail-tab">
        <li class="nav-item <?php echo e(request()->routeIs('jobs.show') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('jobs.show',$providerdata->id)); ?>"> <?php echo e(__('messages.overview')); ?></a>
        </li>
      
        <li class="nav-item <?php echo e(request()->routeIs('applicant.details') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('applicant.details',$providerdata->id)); ?>"> <?php echo e(__('Application Lists')); ?></a>
        </li>

        <li class="nav-item <?php echo e(request()->routeIs('report.details') ? 'active' : ''); ?>">
            <a class="nav-link" href="<?php echo e(route('report.details',$providerdata->id)); ?>"> <?php echo e(__('Report Lists')); ?></a>
        </li>
    </ul>
</div><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/partials/_jobs.blade.php ENDPATH**/ ?>