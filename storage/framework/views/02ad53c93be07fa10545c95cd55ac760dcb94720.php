<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-start align-items-center p-3 ">

                                    <h5 class="font-weight-bold"><?php echo e($pageTitle ?? trans('messages.jobs')); ?></h5>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end align-items-center p-3">
                                    <?php if($auth_user->can('jobs add')): ?>
                                    <a href="<?php echo e(route('jobs.quick')); ?>" class="float-right mr-1 btn btn-sm btn-danger"><i class="fa fa-plus-circle"></i> <?php echo e(trans('messages.add_form_title',['form' => trans('messages.quick_jobs')  ])); ?></a>
                                    <a href="<?php echo e(route('jobs.create')); ?>" class="float-right mr-1 btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> <?php echo e(trans('messages.add_form_title',['form' => trans('messages.jobs')  ])); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e($dataTable->table(['class' => 'table  w-100'],false)); ?>

                </div>
            </div>
        </div>
    </div>
    </div>
    <?php $__env->startSection('bottom_script'); ?>
    <?php echo e($dataTable->scripts()); ?>

    <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/jobs/index.blade.php ENDPATH**/ ?>