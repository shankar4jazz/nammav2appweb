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
                <div class="card">
                    <div class="border-bottom d-flex gap-3 flex-wrap justify-content-between align-items-center px-4 py-3">
                        <div class="d-flex gap-2 align-items-center">
                            <i class="ri-bank-fill"></i>
                            <h4><?php echo e(__('messages.bank_info')); ?></h4>
                        </div>
                        <div class="d-flex gap-2 align-items-center"></div>
                    </div>

                    <div class="card-body p-30">
                      

                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-md-8 col-lg-6 col-xl-5">
                                <div class="card bank-info-card bg-bottom bg-contain bg-img" style="background-image: url('/img/bank-info-card-bg.png');">
                                    <div class="border-bottom p-3">
                                        <h4 class="fw-semibold">
                                             <?php echo e(__('messages.holder')); ?>: <strong><?php echo e(($providerdata->providerbank[0])->providers->display_name ?? '-'); ?></strong> 

                                        </h4>
                                    </div>
                                    <div class="card-body position-relative">
                                        <img class="bank-card-img" src="/img/bank-card.png" alt="" />
                                        <ul class="bank-info-box list-unstyled d-flex flex-column gap-4">
                                            <li>
                                                <h3 class="mb-2"><?php echo e(__('messages.bank_name')); ?>:</h3>
                                                <div><?php echo e(( $providerdata->providerbank[0])->bank_name ?? '-'); ?></div>
                                            </li>
                                            <li>
                                                <h3 class="mb-2"><?php echo e(__('messages.branch_name')); ?>:</h3>
                                                <div><?php echo e(( $providerdata->providerbank[0])->branch_name ?? '-'); ?></div>
                                            </li>
                                            <li>
                                                <h3 class="mb-2"><?php echo e(__('messages.account_no')); ?>:</h3>
                                                <div><?php echo e(( $providerdata->providerbank[0])->account_no ?? '-'); ?></div>
                                            </li>
                                        </ul>
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
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/bank/view.blade.php ENDPATH**/ ?>