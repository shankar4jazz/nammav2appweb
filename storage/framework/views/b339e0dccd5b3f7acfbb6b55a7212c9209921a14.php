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
                            <a href="<?php echo e(route('booking.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php if($auth_user->can('booking list')): ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <?php echo e(Form::model($bookingdata,['method' => 'GET','route'=>'booking.webassigned', 'data-toggle'=>"validator"] )); ?>


                        <?php echo e(Form::hidden('id',$bookingdata->id)); ?>

                        <div class="row">

                            <div class="col-md-6 form-group ">
                                <?php echo e(Form::label('handyman_id', __('messages.select_name',[ 'select' => __('messages.handyman') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php
                                if($bookingdata->booking_address_id != null)
                                {
                                $route = route('ajax-list', ['type' => 'handyman', 'provider_id' => $bookingdata->provider_id, 'booking_id' => $bookingdata->id ]);
                                } else {
                                $route = route('ajax-list', ['type' => 'handyman', 'provider_id' => $bookingdata->provider_id ]);
                                }
                                $assigned_handyman = $bookingdata->handymanAdded->mapWithKeys(function ($item) {
                                return [$item->handyman_id => optional($item->handyman)->display_name];
                                });
                                ?>
                                <?php echo e(Form::select('handyman_id[]', $assigned_handyman, $bookingdata->handymanAdded->pluck('handyman_id'), [
                                'class' => 'select2js handyman',
                                'id' => 'handyman_id',
                                'required',
                                'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.handyman') ]),
                                'data-ajax--url' => $route,
                                ])); ?>

                            </div>

                        </div>

                    </div>
                    <div class="card-footer ">
                        <div class="col-md-6 offset-md-5">
                        <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary'])); ?>

                        <?php echo e(Form::close()); ?>

                        </div>
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


                $('#handyman_id').select2({
                    width: '100%',
                    placeholder: "<?php echo e(__('messages.select_name',['select' => __('messages.handyman')])); ?>",
                });

            });


        })(jQuery);
    </script>

    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/booking/assign_form.blade.php ENDPATH**/ ?>