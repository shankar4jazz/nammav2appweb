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
                    <div class="card-body p-30">
                        <div class="service-man-list">
                            <?php $__currentLoopData = $providerdata->providerHandyman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $handyman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="service-man-list__item">
                                <div class="service-man-list__item_header">
                                    <div class="attach-img-box position-relative">
                                        <?php
                                        $extention = imageExtention(getSingleMedia($providerdata,'profile_image'));
                                        ?>
                                        <img id="profile_image_preview" src="<?php echo e(getSingleMedia($providerdata,'profile_image')); ?>" alt="#" class="attachment-image mt-1" style="background-color:<?php echo e($extention == 'svg' ? $providerdata->color : ''); ?>">
                                        <a class="text-danger remove-file" href="<?php echo e(route('remove.file', ['id' => $providerdata->id, 'type' => 'profile_image'])); ?>" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-message='<?php echo e(__("messages.remove_file_msg")); ?>'>
                                            <i class="ri-close-circle-line"></i>
                                        </a>
                                    </div>
                                    <h4 class="service-man-name"><?php echo e($handyman->display_name ?? '-'); ?></h4>
                                    <a class="service-man-phone" href="<?php echo e($handyman->contact_number); ?>"><?php echo e($handyman->contact_number ?? '-'); ?></a>
                                </div>
                                <div class="service-man-list__item_body">
                                    <a class="service-man-mail" href="<?php echo e($handyman->email); ?>"><?php echo e($handyman->email ?? '-'); ?></a>
                                    <p class="service-man-address"><?php echo e($handyman->address ?? '-'); ?></p>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php echo e(Form::close()); ?>

    <?php $__env->startSection('bottom_script'); ?>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/handyman/view.blade.php ENDPATH**/ ?>