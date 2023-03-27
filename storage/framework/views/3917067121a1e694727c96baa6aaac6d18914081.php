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
                            <h5 class="font-weight-bold"><?php echo e($pageTitle ?? __('messages.list')); ?></h5>
                           
                            <?php if($customerdata->type == 'booking' ): ?>

                            <a href="<?php echo e(route('quickbooking')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i><?php echo e(__('messages.back')); ?></a>

                            <?php endif; ?>
                            <?php if($customerdata->type == 'jobs' ): ?>

                            <a href="<?php echo e(route('jobs.quick')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i><?php echo e(__('messages.back')); ?></a>

                            <?php endif; ?>
                            <?php if($auth_user->can('user list')): ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($customerdata,['method' => 'POST','route'=>'user.quick', 'data-toggle'=>"validator" ,'id'=>'user'] )); ?>

                        <?php echo e(Form::hidden('id')); ?>

						 <?php if($customerdata->type == 'booking' ): ?>
                        <?php echo e(Form::hidden('user_type','user')); ?>

						 <?php endif; ?>
						 <?php if($customerdata->type == 'jobs' ): ?>
						<?php echo e(Form::hidden('user_type', 'jobs')); ?>

						<?php endif; ?>
                        <input type="hidden" name="type" value="<?php echo e($customerdata->type); ?>">
                        <div class="col offset-md-3">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('first_name',__('messages.first_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('first_name',old('first_name'),['placeholder' => __('messages.first_name'),'class' =>'form-control','required'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::hidden('username',old('username'),['placeholder' => __('messages.username'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::hidden('email',old('email'),['placeholder' => __('messages.email'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('contact_number',__('messages.contact_number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('contact_number',old('contact_number'),['readonly', 'placeholder' => __('messages.contact_number'),'class' =>'form-control','required'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-2 mt-4">

                                    <?php if($customerdata->type == 'booking' ): ?>

                                    <a href="<?php echo e(route('quickbooking')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>Change Number</a>

                                    <?php endif; ?>
                                    <?php if($customerdata->type == 'jobs' ): ?>

                                    <a href="<?php echo e(route('jobs.quick')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i>Change Number</a>

                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group col-md-4" id=" hideStatus">
                                <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required'])); ?>

                            </div>

                            <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary offset-md-3'])); ?>


                        </div>


                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startSection('bottom_script'); ?>

    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {

                document.getElementById(" hideStatus").style.display = "none";

            });



        })(jQuery);
    </script>

    <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/customer/quickcreate.blade.php ENDPATH**/ ?>