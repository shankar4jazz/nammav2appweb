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
                            <a href="<?php echo e(route('plans.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($plan,['method' => 'POST','route'=>'jobs-payment.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'plan'] )); ?>

                        <?php echo e(Form::hidden('id')); ?>

                        <input type="hidden" id="employer_id" name="employer_id" value="<?php echo e($plan->employer_id); ?>">
                        <input type="hidden" id="all_total_amount" name="all_total_amount" value="<?php echo e($plan->total_amount); ?>">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('job_id', __('messages.select_name',[ 'select' => __('Job') ]),['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('job_id', [], old('job_id'), [
                                        'class' => 'select2js form-group service',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('job') ]),
                                        'data-type' => 'my-custom-type'                                        
                                    ])); ?>

                            </div>

                            <?php $__currentLoopData = $plan_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group col-md-6">
                                <div class="card-body table-responsive">
                                    <table class="table text-center table-bordered bg_white">
                                        <tr>
                                            <th colspan="2"><?php echo e($data->en_name); ?> -(<?php echo e($data->ta_name); ?>)</th>
                                        </tr>
                                        <?php $__currentLoopData = $data->getPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>

                                            <td style="background-color:lightgreen;"><input class="checkbox no-wh permission_check" id="permission-<?php echo e($p->id); ?>" type="radio" name="plan_id" value='<?php echo e($p->id); ?>' onclick='updateFields("<?php echo e($p->id); ?>", "<?php echo e($p->total_amount); ?>");' <?php echo e($p->id ==  $plan->plan_id? 'checked' : ''); ?>> </td>
                                            <td style="background-color:lightgreen;" class="text-capitalize"><?php echo e($p->duration); ?> <?php echo e($p->type); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::label('Price',__('Actual Price'), ['class' => 'form-control-label'],false)); ?>

                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::number('price', $p->price, old('$p->price'),['placeholder' => __('Price'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                <?php echo e($p->percentage); ?>

                                                <?php echo e(Form::label('Price',__('Offer in Percentage %'), ['class' => 'form-control-label'],false)); ?>

                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::number('percentage', $p->percentage, old('@p->percentage'),['placeholder' => __('Offer'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::label('Price',__('Sub Total'), ['class' => 'form-control-label'],false)); ?>

                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::number('amount', $p->amount, old('$p->amount'),['placeholder' => __('Sub Total'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::label('Price',__('Tax in Percentage'), ['class' => 'form-control-label'],false)); ?>

                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::number('tax', $p->tax ,old('$p->tax'),['placeholder' => __('tax'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::label('Price',__('Total Amount'), ['class' => 'form-control-label'],false)); ?>

                                            </td>
                                            <td class="text-capitalize">
                                                <?php echo e(Form::number('total_amount',$p->total_amount,old('$p->total_amount'),['placeholder' => __('tax'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </table>

                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('payment_type',trans('Payment type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('payment_type',['online' => __('Online') ,'bank' => __('Bank Transfer') , 'cash' => __('Cash') ],old('type'),[ 'id' => 'payment_type' ,'class' =>'form-control select2js','required'])); ?>

                            </div>


                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <?php echo e(Form::label('description',__('messages.description'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"description", 'placeholder'=> __('messages.description') ])); ?>

                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo e(Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                            <?php echo e(Form::select('payment_status',['paid' => __('Paid') , 'pending' => __('Pending'), 'failed' => __('Failed') ],old('payment_status'),[ 'id' => 'payment_status' ,'class' =>'form-control select2js','required'])); ?>

                        </div>
                        <?php echo e(Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $__env->startSection('bottom_script'); ?>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {

                var job_id = "<?php echo e(isset($plan->job_id) ? $plan->job_id : ''); ?>";

                getJobs(job_id);
                getEmployer(job_id);
                getPlans();

                CKEDITOR.replace('editor');

            });
                //     $(".checklist:checkbox").each(function() {
                //         if ($(this).is(":checked")) {
                //             showCheckLimitData($(this).attr("id"));
                //         }
                //     });
                //     var value = $("#plan_limitation option:selected").attr('data-type');
                //     showLimitCheckbox(value)

                //     $(document).on('change' , '#plan_limitation' , function (){
                //         var data = $("#plan_limitation option:selected").attr('data-type');
                //         showLimitCheckbox(data)
                //     })

                // function showLimitCheckbox(type){
                //     if(type === 'limited'){
                //         $('.show-checklist').removeClass('d-none')
                //     }else{
                //         $('.show-checklist').addClass('d-none')
                //     }
                //     if(type === 'free'){
                //         $('.show_trial_period').removeClass('d-none')
                //     }else{
                //         $('.show_trial_period').addClass('d-none')
                //     }
                // }

                $(document).on('change', '#job_id', function() {
                    var job_id = $(this).val();

                    getEmployer(job_id);
                })

                window.updateFields = function(plan_id, total_amount) {
                    document.getElementById('all_total_amount').value = total_amount;
                    // Any other fields you want to update based on the selected radio button
                };

                // function updateFields(plan_id, total_amount) {
                //     document.getElementById('all_total_amount').value = total_amount;
                //     // Any other fields you want to update based on the selected radio button
                // }

                function getJobs(job_id="") {

                    var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'get-jobs', 'job_id' =>''])); ?>" + job_id;
                    state_route = state_route.replace('amp;', '');


                    $.ajax({
                        url: state_route,
                        success: function(result) {
                            console.log(result.results);
                            $('#job_id').select2({
                                width: '100%',
                                placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                                data: result.results
                            });

                            if (job_id != null) {
                                $("#job_id").val(state).trigger('change');
                            }
                        }
                    });
                }

                function getEmployer(job_id, state = "") {

                    var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'get-employer', 'job_id' =>''])); ?>" + job_id;
                    state_route = state_route.replace('amp;', '');


                    $.ajax({
                        url: state_route,
                        success: function(result) {

                            $("#employer_id").val(result.results[0].user_id);
                            console.log(result.results);
                            // $('#job_id').select2({
                            //     width: '100%',
                            //     placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                            //     data: result.results
                            // });

                        }
                    });
                }

                function getPlans(job_id = "") {

                    var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'get-plans'])); ?>";
                    state_route = state_route.replace('amp;', '');


                    $.ajax({
                        url: state_route,
                        success: function(result) {
                            $('#job_id').select2({
                                width: '100%',
                                placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                                data: result.results
                            });
                            if (job_id != null) {
                                $("#job_id").val(state).trigger('change');
                            }
                        }
                    });
                }
          
        })(jQuery);
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobspayment/create.blade.php ENDPATH**/ ?>