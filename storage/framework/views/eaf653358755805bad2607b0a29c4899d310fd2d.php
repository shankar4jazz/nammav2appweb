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
                            <h5 class="font-weight-bold"><?php echo e($pageTitle ?? __('messages.quick_form_title')); ?></h5>

                            <a href="<?php echo e(route('booking.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php if($auth_user->can('booking list')): ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-md-3">
                <div class="card w-100 p-3">
                    <div class="card-body">
                        <?php echo e(Form::label('brand',__('messages.enter_customer_mobile_no').' <span class="text-danger">*</span>',['id'=>'mobile_label', 'class'=>'form-control-label', 'style'=>'font-size:25px; font-weight:bold'], false )); ?>


                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">

                                <?php echo e(Form::text('mobile_no', null, ['class'=>"form-control" , 'rows'=>3  ,  'style'=>'font-size:25px;font-weight:bold', 'id'=>'mobile_no' ])); ?>

                                <div id="wrong-egn" class="text-danger" style='font-size:20px;'>Please provide 10 digit number.</div>
                            </div>


                        </div>


                    </div>
                    <div class="card-footer">
                        <?php echo e(Form::button( __('messages.process'), ['class'=>'btn btn-md btn-primary offset-md-5', 'id'=>"process"])); ?>

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
                document.getElementById("wrong-egn").style.display = "none";
                $(document).on('click', '#process', function(e) {
                    var value = document.getElementById("mobile_no").value;
                    console.log(value);
                    if (value.length === 10) {
                        $('#wrong-egn').slideUp();
                        e.preventDefault();
                        checkExistCustomer(value);
                    } else {
                        $('#wrong-egn').slideDown();
                    }

                })

            });

            function checkExistCustomer(mobile_no) {

                var get_subcategory_list = "<?php echo e(route('ajax-list', [ 'type' => 'existing_customer', 'user_type'=> 'jobs', 'mobile_no' =>''])); ?>" + mobile_no;
				
                get_subcategory_list = get_subcategory_list.replace(/amp;/g, '');
				console.log(get_subcategory_list);

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        var data = result.results;
                       
                        if (data.status_code == 404) {
                            var url =  "<?php echo e(route('user.quickcreate', ['type'=>'jobs', 'mobile_no' =>''])); ?>" + mobile_no;
                            url = url.replace('amp;', '');
                            window.location.href = url;
                        }
                        if (data.status_code == 200) {

                          window.location.href = "<?php echo e(route('jobs.jobadd', ['mobile_no' =>''])); ?>" + mobile_no;
                        }
                    }
                });
            }

        })(jQuery);
    </script>

    <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/jobs/fast.blade.php ENDPATH**/ ?>