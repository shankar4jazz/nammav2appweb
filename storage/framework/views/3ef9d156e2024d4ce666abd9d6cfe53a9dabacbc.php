<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<section class="login-content">
    <div class="container h-100">
       <div class="row align-items-center justify-content-center h-100">
          <div class="col-md-5">
             <div class="card p-3">
                <div class="card-body">
                   <!-- <div class="auth-logo">
                      <img src="<?php echo e(getSingleMedia(settingSession('get'),'site_logo',null)); ?>" class="img-fluid rounded-normal" alt="logo">
                   </div> -->
                   <!-- <h3 class="mb-3 font-weight-bold text-center"><?php echo e(__('auth.get_start')); ?></h3> -->
                   <!-- Session Status -->
                   <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-session-status','data' => ['class' => 'mb-4','status' => session('status')]]); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

                   <!-- Validation Errors -->
                   <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                   <form method="POST" action="<?php echo e(route('sent')); ?>" data-toggle="validator">
                   <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="mobile" class="text-secondary"><?php echo e(__('Enter mobile Number')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" id="mobile"  name="mobile_no" value="" required placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('mobile number') ])); ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="text class="text-secondary"><?php echo e(__('Enter Text')); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="text"  name="text" value="" required placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('the text') ])); ?>"></textarea>
                                </div>
                            </div>
                           
                      </div>
                      <button type="submit" class="btn btn-primary btn-block mt-2"><?php echo e(__('Send')); ?></button>
                     
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/sms/sms.blade.php ENDPATH**/ ?>