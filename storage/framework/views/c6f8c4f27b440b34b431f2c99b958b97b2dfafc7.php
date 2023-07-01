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
                   <div class="auth-logo">
                      <img src="<?php echo e(getSingleMedia(settingSession('get'),'site_logo',null)); ?>" class="img-fluid rounded-normal" alt="logo">
                   </div>
                   <h3 class="mb-3 font-weight-bold text-center"><?php echo e(__('auth.get_start')); ?></h3>
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
                   <form method="POST" action="<?php echo e(route('register')); ?>" data-toggle="validator">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="username" class="text-secondary"><?php echo e(__('auth.username')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" id="username"  name="username" value="<?php echo e(old('username')); ?>" required placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('auth.username') ])); ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="first_name" class="text-secondary"><?php echo e(__('auth.first_name')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" id="first_name"  name="first_name" value="<?php echo e(old('first_name')); ?>" required placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('auth.first_name') ])); ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="last_name" class="text-secondary"><?php echo e(__('auth.last_name')); ?> <span class="text-danger">*</span></label>
                                    <input class="form-control" id="last_name"  name="last_name" value="<?php echo e(old('last_name')); ?>" required placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('auth.last_name') ])); ?>">
                                </div>
                            </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                               <label for="email" class="text-secondary"><?php echo e(__('auth.email')); ?> <span class="text-danger">*</span></label>
                               <input class="form-control" type="email" id="email"  name="email" value="<?php echo e(old('email')); ?>" required placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('auth.email') ])); ?>">
                            </div>
                         </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                               <label for="password" class="text-secondary"><?php echo e(__('auth.login_password')); ?> <span class="text-danger">*</span></label>
                               <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password"  placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('auth.login_password') ])); ?>">
                            </div>
                         </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="password_confirmation" class="text-secondary"><?php echo e(__('auth.confirm_password')); ?> <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"  placeholder="<?php echo e(__('auth.enter_name',[ 'name' => __('auth.confirm_password') ])); ?>">
                            </div>
                        </div>
                         <div class="col-lg-12 mt-2">
                               <div class="form-check mb-3 d-flex align-items-center">
                                   <input type="checkbox" class="form-check-input mt-0" id="customCheck1" required>
                                   <label class="form-check-label pl-2" for="customCheck1"><?php echo e(__('auth.agree')); ?> <a href="#"><?php echo e(__('auth.term_service')); ?></a> & <a href="#"><?php echo e(__('auth.privacy_policy')); ?></a> </label>
                               </div>
                         </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-block mt-2"><?php echo e(__('auth.create_account')); ?></button>
                      <div class="col-lg-12 mt-3">
                           <p class="mb-0 text-center"><?php echo e(__('auth.already_have_account')); ?> <a href="<?php echo e(route('auth.login')); ?>"><?php echo e(__('auth.sign_in')); ?></a></p>
                      </div>
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
<?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/auth/register.blade.php ENDPATH**/ ?>