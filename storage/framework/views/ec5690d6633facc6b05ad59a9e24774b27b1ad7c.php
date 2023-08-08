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
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold"><?php echo e($pageTitle ?? trans('messages.list')); ?></h5>
                            <?php if($auth_user->can('service add')): ?>
                            <a href="<?php echo e(route('service.create')); ?>" class="float-right mr-1 btn btn-sm btn-primary "><i class="fa fa-plus-circle"></i> <?php echo e(__('messages.add_form_title',['form' => __('messages.service')  ])); ?></a>
                            <?php endif; ?>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/service/index.blade.php ENDPATH**/ ?>