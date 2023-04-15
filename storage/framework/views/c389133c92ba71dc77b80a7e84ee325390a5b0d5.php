<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php echo e(Form::open(['route' => ['provider.destroy', $providerdata->id], 'method' => 'delete','data--submit'=>'provider'.$providerdata->id])); ?>

    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                <?php echo $__env->make('partials._provider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card mb-30">
                    <div class="card-body p-30">
                        <div class="col-lg-12">
                            <div class="card overview-detail mb-0">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('type',trans('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                            <input type="text" class="form-control" placeholder="<?php echo e($providerdata->providertype['type']); ?>" readonly>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo e(Form::label('commission',trans('messages.commission').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                            <input type="text" class="form-control" placeholder="<?php echo e($providerdata->providertype['commission']); ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php echo e(Form::close()); ?>

    <?php $__env->startSection('bottom_script'); ?>
    <?php echo e($dataTable->scripts()); ?>

    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/setting/comission.blade.php ENDPATH**/ ?>