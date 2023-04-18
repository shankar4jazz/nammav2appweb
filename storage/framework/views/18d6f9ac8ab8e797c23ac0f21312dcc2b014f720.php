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
                            <?php if($auth_user->can('category list')): ?>
                            <a href="<?php echo e(route('jobs.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <?php echo e(Form::model($jobsdata,['method' => 'POST','route'=>'jobs.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'jobsdata'] )); ?>

                        <?php echo e(Form::hidden('id')); ?>

                        <?php if(auth()->user()->hasRole(['admin'])): ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('title',old('title'),['placeholder' => trans('messages.title'), 'id' =>'title', 'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-1 mt-5">
                                <input type='button' id="convert_slug" value="Convert Slug">
                            </div>
                            <div class="form-group col-md-5">
                                <?php echo e(Form::label('slug',trans('messages.slug').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('slug',old('slug'),['placeholder' => trans('messages.slug'), 'id' =>'slug', 'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <!-- 
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('contact_number',__('messages.customer').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('contact_number',  null, ['class'=>"form-control" , 'id'=>'contact_number', 'readonly', 'rows'=>3  , 'placeholder'=> __('messages.customer') ])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div> -->
                            <?php if(auth()->user()->hasRole(['admin'])): ?>
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('user_id', __('messages.select_name',[ 'select' => __('messages.user') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('user_id', [optional($jobsdata->user)->id => optional($jobsdata->user)->contact_number], optional($jobsdata->user)->id, [
                                                'class' => 'select2js form-group user',
                                                'required',
                                                'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.user') ]),
                                                'data-ajax--url' => route('ajax-list', ['type' => 'jobs']),
                                            ])); ?>

                            </div>
                            <?php else: ?>
                            <input type="hidden" name="user_id" value="<?php echo e($jobsdata->user_id); ?>">
                            <?php endif; ?>

                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('contact number',trans('Contact number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::number('contact_number',old('contact_number'),['placeholder' => trans('Enter Contact Number'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>


                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('job_role',trans('messages.job_role').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('job_role',old('job_role'),['placeholder' => trans('messages.job_role'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('tamil_job_role',trans('தமிழில் வேலைப்பெயர்(Job Role)').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('tamil_job_role',old('tamil_job_role'),['placeholder' => trans('வேலைப்பெயர்'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('company_name',trans('messages.company_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('company_name',old('company_name'),['placeholder' => trans('messages.company_name'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('tamil_company_name',trans('தமிழில் கம்பெனி பெயர்').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('tamil_company_name',old('tamil_company_name'),['placeholder' => trans('கம்பெனி பெயர்'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('jobcategory_id', __('messages.select_name',[ 'select' => __('messages.jobs_category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('jobcategory_id', [optional($jobsdata->jobscategory)->id => optional($jobsdata->jobscategory)->name], optional($jobsdata->jobscategory)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.jobs_category') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'jobs-category']),
                                        ])); ?>


                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('education',trans('messages.education').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('education',['1' => __('messages.edu_1') , '0' => __('messages.edu_0'), '2' => __('messages.edu_2') ,'3' => __('messages.edu_3') ],old('education'),[ 'id' => 'edu' ,'class' =>'form-control select2js','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('gender',trans('messages.gender').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('gender',['0' => __('messages.gender_0') , '1' => __('messages.gender_1'), '2' => __('messages.gender_2')  ],old('gender'),[ 'id' => 'gender' ,'class' =>'form-control select2js','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('marital_status',trans('messages.marital').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('marital_status',['1' => __('messages.marital_1') , '0' => __('messages.marital_0'), '2' => __('Both') ],old('gender'),[ 'id' => 'marital' ,'class' =>'form-control select2js','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('experience',trans('messages.experience').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('experience',['0' => __('messages.exp_0') , '1' => __('messages.exp_1'), '2' => __('messages.exp_2') ,'3' => __('messages.exp_3'), '4' => __('messages.exp_4'), '5' => __('messages.exp_5') ],old('status'),[ 'id' => 'exp' ,'class' =>'form-control select2js','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-2">
                                <?php echo e(Form::label('min_salary',trans('messages.min_salary').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::number('min_salary',old('min_salary'),['placeholder' => trans('messages.min_salary'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-2">
                                <?php echo e(Form::label('max_salary',trans('messages.min_salary').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::number('max_salary',old('max_salary'),['placeholder' => trans('messages.max_salary'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('vacancy',trans('messages.vacancy').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::number('vacancy',old('vacancy'),['placeholder' => trans('messages.vacancy'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('start_date',__('messages.start_date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('start_date',old('start_date'),['placeholder' => __('messages.start_date'),'class' =>'form-control end-datetimepicker','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('end_date',__('messages.end_date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('end_date',old('end_date'),['placeholder' => __('messages.end_date'),'class' =>'form-control end-datetimepicker','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('description',trans('messages.description'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('description', $decoded_description, ['class'=>"form-control textarea" , 'rows'=>3  , 'id'=>"editor", 'placeholder'=> __('messages.description') ])); ?>

                            </div>

                            <div class="row col-md-12">
                                <div class="form-group col-md-4 d-none">
                                    <?php echo e(Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]),['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('country_id', [optional($jobsdata->country)->id => optional($jobsdata->country)->name], optional($jobsdata->country)->id, [
                                        'class' => 'select2js form-group country',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.country') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'country']),
                                    ])); ?>

                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]), ['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('state_id', [
                                        
                                        'class' => 'select2js form-group state_id',
                                    
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
                                    ])); ?>

                                    <input type="hidden" name="state_id" value="<?php echo e($jobsdata->state_id); ?>" />
                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('district_id', __('messages.select_name',[ 'select' => __('messages.district') ]),['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('district_id', [], old('district_id'), [
                                        'class' => 'select2js form-group district_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.district') ]),
                                    ])); ?>

                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('city_id', __('messages.select_name',[ 'select' => __('messages.city') ]),['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('city_id', [], old('city_id'), [
                                        'class' => 'select2js form-group city_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.city') ]),
                                    ])); ?>

                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('pincode',trans('messages.pincode'),['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('pincode',old('pincode'),['placeholder' => trans('messages.pincode'),'class' =>'form-control'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-8">
                                    <?php echo e(Form::label('address',trans('messages.address'), ['class' => 'form-control-label'])); ?>

                                    <?php echo e(Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>2  , 'placeholder'=> __('messages.address') ])); ?>

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="jobs_image"><?php echo e(__('messages.image')); ?> </label>
                                <div class="custom-file">
                                    <input type="file" name="jobs_image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label upload-label"><?php echo e(__('messages.choose_file',['file' =>  __('messages.image') ])); ?></label>
                                </div>
                                <span class="selected_file"></span>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('districts for jobs') ]),['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('districts[]', [], old('districts'), [
                                        'class' => 'select2js form-group tax_id',
                                        'id' =>'tax_id',
                                        'multiple' => 'multiple',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('districts for jobs') ]),
                                    ])); ?>


                            </div>


                            <?php if(getMediaFileExit($jobsdata, 'jobs_image')): ?>
                            <div class="col-md-2 mb-2">
                                <?php
                                $extention = imageExtention(getSingleMedia($jobsdata,'jobs_image'));
                                ?>
                                <img id="jobs_image_preview" src="<?php echo e(getSingleMedia($jobsdata,'jobs_image')); ?>" alt="#" class="attachment-image mt-1">
                                <a class="text-danger remove-file" href="<?php echo e(route('remove.file', ['id' => $jobsdata->id, 'type' => 'jobs_image'])); ?>" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-message='<?php echo e(__("messages.remove_file_msg")); ?>'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            <?php endif; ?>

                            <?php if(auth()->user()->hasRole(['admin'])): ?>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('Pending'), '2' => __('messages.rejected') ,'3' => __('Suspended'), '4' => __('InActive')],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-12" style="display:none" id="reason">
                                <?php echo e(Form::label('reject_reason',trans('messages.reason'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('reject_reason', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.reason') ])); ?>

                            </div>

                            <?php else: ?>
                            <input type="hidden" name="status" value="0">
                            <?php endif; ?>
                        </div>
                        <?php if(auth()->user()->hasRole(['admin'])): ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <!-- <input type="checkbox" name="is_featured" value="1" class="custom-control-input" id="is_featured"> -->
                                    <?php echo e(Form::checkbox('is_featured', $jobsdata->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_featured' ])); ?>

                                    <label class="custom-control-label" for="is_featured"><?php echo e(__('messages.set_as_featured')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <?php endif; ?>
                        <?php echo e(Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $data = $jobsdata->getJobDistricts->pluck('district_id')->implode(',');
    ?>
    <?php $__env->startSection('bottom_script'); ?>
    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {
                CKEDITOR.replace('editor');
                var districts = "<?php echo e(isset($data) ? $data : []); ?>";
                //console.log(districts);


                var country_id = "<?php echo e(isset($jobsdata->country_id) ? $jobsdata->country_id : 101); ?>";
                var user_id = "<?php echo e(isset($jobsdata->user_id) ? $jobsdata->user_id : 0); ?>";
                var state_id = "<?php echo e(isset($jobsdata->state_id) ? $jobsdata->state_id : 35); ?>";
                var district_id = "<?php echo e(isset($jobsdata->district_id) ? $jobsdata->district_id : 0); ?>";
                var city_id = "<?php echo e(isset($jobsdata->city_id) ? $jobsdata->city_id : 0); ?>";

                // var provider_id = "<?php echo e(isset($jobsdata->provider_id) ? $jobsdata->provider_id : '4'); ?>";
                var service_address_id = "<?php echo e(isset($jobsdata->service_address_id) ? $jobsdata->service_address_id : 0); ?>";
                userName(user_id);
                var provider_id = '5';

                $('#state_id').attr('disabled', true);
                stateName(country_id, state_id);
                getTax(provider_id, districts);

                //districtName(state_id, district_id);
                //providerAddress(provider_id, service_address_id);
                $(document).on('change', '#role', function() {
                    var status = $(this).val();
                    if (status == '3' || status == '4' || status == '2') {

                        document.getElementById("reason").style.display = "block";
                    } else {
                        document.getElementById("reason").style.display = "none";

                    }

                })
                $(document).on('change', '#country_id', function() {
                    var country = $(this).val();
                    $('#state_id').empty();
                    $('#district_id').empty();
                    $('#city_id').empty();
                    stateName(country);
                })
                $(document).on('change', '#state_id', function() {
                    var state = $(this).val();
                    $('#district_id').empty();
                    $('#city_id').empty();
                    districtName(state, district_id);
                })
                $(document).on('change', '#district_id', function() {
                    var district = $(this).val();
                    $('#city_id').empty();
                    cityName(district, city_id);
                })
                $(document).on('change', '#provider_id', function() {
                    var provider_id = $(this).val();
                    $('#service_address_id').empty();
                    //providerAddress(provider_id, service_address_id);
                })

            })

            function getTax(provider_id, provider_tax_id = "") {

                var provider_tax_route = "<?php echo e(route('ajax-list', [ 'type' => 'district','provider_id' =>''])); ?>" + provider_id;
                provider_tax_route = provider_tax_route.replace('amp;', '');

                $.ajax({
                    url: provider_tax_route,
                    success: function(result) {
                        $('#tax_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.tax')])); ?>",
                            data: result.results
                        });
                        if (provider_tax_id != "") {
                            // alert("value");
                            $('#tax_id').val(provider_tax_id.split(',')).trigger('change');
                        }
                    }
                });
            }

            function stateName(country, state = "") {
                var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'state','country_id' =>''])); ?>" + country;
                state_route = state_route.replace('amp;', '');

                $.ajax({
                    url: state_route,
                    success: function(result) {
                        $('#state_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                            data: result.results

                        });
                        if (state != null) {
                            $("#state_id").val(state).trigger('change');
                        }
                    }
                });
            }

            function districtName(state_id, district = "") {
                // console.log(district);
                var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'district','state_id' =>''])); ?>" + state_id;
                state_route = state_route.replace('amp;', '');

                $.ajax({
                    url: state_route,
                    success: function(result) {
                        $('#district_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.district')])); ?>",
                            data: result.results
                        });
                        if (district != null) {
                            $("#district_id").val(district).trigger('change');
                        }
                    }
                });
            }

            function cityName(district, city = "") {
                var city_route = "<?php echo e(route('ajax-list', [ 'type' => 'city' ,'district_id' =>''])); ?>" + district;
                city_route = city_route.replace('amp;', '');

                $.ajax({
                    url: city_route,
                    success: function(result) {
                        $('#city_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.city')])); ?>",
                            data: result.results
                        });
                        if (city != null || city != 0) {
                            $("#city_id").val(city).trigger('change');
                        }
                    }
                });
            }

            function userName(user, city = "") {
                var city_route = "<?php echo e(route('ajax-list', [ 'type' => 'get-user' ,'user_id' =>''])); ?>" + user;
                city_route = city_route.replace('amp;', '');

                $.ajax({
                    url: city_route,
                    success: function(result) {
                        $('#user_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.city')])); ?>",
                            data: result.results
                        });
                        // if (city != null || city != 0) {
                        //     $("#user_id").val(city).trigger('change');
                        // }
                    }
                });
            }

            $(document).on('change', '#district_id', function() {
                var provider_id = $(this).val();
                $('#provider_address_id').empty();
                // providerAddress(provider_id, provider_address_id);
            })

            function providerAddress(provider_id, service_address_id = "") {
                var provider_address_route = "<?php echo e(route('ajax-list', [ 'type' => 'provider_address','provider_id' =>''])); ?>" + provider_id;
                provider_address_route = provider_address_route.replace('amp;', '');

                $.ajax({
                    url: provider_address_route,
                    success: function(result) {
                        $('#service_address_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.provider_address')])); ?>",
                            data: result.results
                        });
                        if (service_address_id != "") {
                            $('#service_address_id').val(service_address_id).trigger('change');
                        }
                    }
                });
            }

            function textToSlug(text) {
                return text.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '');
            }

            var button = document.getElementById("convert_slug");

            button.addEventListener("click", function() {
                const timestamp = Date.now();
                var textbox = document.getElementById("title");
                var slug = textToSlug(textbox.value);
                var textbox = document.getElementById("slug");
                textbox.value = slug + "-" + timestamp;
            });


        })(jQuery);
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobs/create.blade.php ENDPATH**/ ?>