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
                        <?php echo e(Form::model($plan,['method' => 'POST','route'=>'jobs-plans.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'plan'] )); ?>

                        <?php echo e(Form::hidden('id')); ?>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                
                                <?php echo e(Form::select('plancategory_id', [optional($plan->jobsplans)->id => optional($plan->jobsplans)->ta_name], optional($plan->jobsplans)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.category') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs_plan_category'],true, 'https'),
                                        ])); ?>


                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('title',trans('messages.title').' <span class="text-danger"></span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('type',trans('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('type',['monthly' => __('messages.monthly') , 'yearly' => __('messages.yearly') ],old('type'),[ 'id' => 'type' ,'class' =>'form-control select2js','required'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('duration',trans('messages.duration').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('duration',['1' => '1' , '2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12' ],old('duration'),[ 'id' => 'duration' ,'class' =>'form-control select2js','required'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('Price',__('Actual Price').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

                                <?php echo e(Form::number('price',old('price'),['placeholder' => __('Price'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('amount',__('Offer in Percentage(example:10, without % symbol)').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

                                <?php echo e(Form::number('percentage',old('percentage'),['placeholder' => __('Enter percentage'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('amount',__('messages.amount').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

                                <?php echo e(Form::number('amount',old('amount'),['placeholder' => __('messages.amount'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('tax',__('Tax in Percentage(example:10, without % symbol)').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

                                <?php echo e(Form::number('tax',old('tax'),['placeholder' => __('Enter tax percentage'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('total_amount',__('Total Amount').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

                                <?php echo e(Form::number('total_amount',old('total_amount'),['placeholder' => __('Total Amount'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required'])); ?>

                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('plan_type',trans('messages.plan_limitation').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <select class='form-control select2js' id='plan_limitation' name="plan_type">
                                    <?php $__currentLoopData = $plan_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->value); ?>" data-type="<?php echo e($value->value); ?>" <?php echo e($plan->plan_type == $value['value']  ? 'selected' : ''); ?>><?php echo e($value->label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <?php echo e(Form::label('description',__('messages.description'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"editor", 'placeholder'=> __('messages.description') ])); ?>

                            </div>
                        </div>
                        <div>
                            <?php $__currentLoopData = $plan_limit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $planValue = $plan->planlimit;
                            if (!empty($planValue)) {
                                $planValue = $plan->planlimit->plan_limitation;
                                if (!array_key_exists('is_checked', $planValue[$value->value])) {
                                    $planValue[$value->value]['is_checked'] = 'off';
                                }
                            } else {
                                $planValue = null;
                            }

                            ?>

                            <div class="row d-none show-checklist" id="show-checklist">
                                <div class="form-group col-md-6">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <?php echo e(Form::checkbox("plan_limitation[$value->value][is_checked]", $planValue!= null ? $planValue[$value->value]['is_checked'] : null, $planValue!= null && $planValue[$value->value]['is_checked'] == 'on' ? true : false, ['class' => 'custom-control-input checklist' , 'id' => "enable_".$value->value ,'onClick' => "showCheckLimitData('enable_$value->value')"  ])); ?>

                                        <label class="custom-control-label" for="<?php echo e('enable_'.$value->value); ?>"><?php echo e(__('messages.plan_limitations',['keyword' => __('messages.'.$value->value)] )); ?>

                                        </label>
                                    </div>
                                </div>
                                <div class=" col-md-6 d-none <?php echo e('enable_'.$value->value); ?>" id="show-limit-<?php echo e($key); ?>">
                                    <div class="form-group">
                                        <?php echo e(Form::label('service_limit',__('messages.limit'), ['class' => 'form-control-label'])); ?>

                                        <?php echo e(Form::number("plan_limitation[$value->value][limit]",$planValue!= null ? $planValue[$value->value]['limit'] : null,['placeholder' => __('messages.plan_limitations',['keyword' => __('messages.'.$value->value)] ),'class' =>'form-control', 'step' => 'any', 'min' => 0])); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="row d-none show_trial_period">
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('trial_period',__('messages.trial_period'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::number('trial_period',old('trial_period'),['placeholder' => __('messages.trial_period'),'class' =>'form-control', 'step' => 'any', 'min' => 0])); ?>

                            </div>
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
       
                CKEDITOR.replace('editor');
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
            });
        })(jQuery);
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobsplan/create.blade.php ENDPATH**/ ?>