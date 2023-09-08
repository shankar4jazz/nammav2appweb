<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-block card-stretch">
                                    <div class="card-body p-0">
                                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                                            <h5 class="font-weight-bold"><?php echo e($pageTitle); ?></h5>
                                            <a href="<?php echo e(route('jobseeker.index')); ?>   " class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-block card-stretch">
                                    <div class="card-body">
                                        <?php echo e(Form::model($customerdata,['method' => 'POST','route'=>'jobseeker.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'user'] )); ?>

                                        <?php echo e(Form::hidden('id')); ?>

                                        <?php echo e(Form::hidden('user_type','jobseeker')); ?>

                                        <div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px; border-radius: 5px;">

                                            <h5 class="card-title" style="margin-top: 0; border-bottom: 1px solid gray; padding-bottom: 10px; margin-bottom: 20px;"><?php echo e(__('Personal Details')); ?></h5>


                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('first_name',__('messages.first_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::text('first_name',old('first_name'),['placeholder' => __('messages.first_name'),'class' =>'form-control','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('last_name',__('messages.last_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::text('last_name',old('last_name'),['placeholder' => __('messages.last_name'),'class' =>'form-control','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('username',__('messages.username').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::text('username',old('username'),['placeholder' => __('messages.username'),'class' =>'form-control','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('email',__('messages.email').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::email('email',old('email'),['placeholder' => __('messages.email'),'class' =>'form-control','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('dob',__('Date of Birth').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::text('dob',old('start_date'),['placeholder' => __('Date of Birth'),'class' =>'form-control end-datetimepicker','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('gender',trans('messages.gender').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                                    <?php echo e(Form::select('gender',['0' => __('messages.gender_0') , '1' => __('messages.gender_1'), '2' => __('messages.gender_2')  ],old('gender'),[ 'id' => 'gender' ,'class' =>'form-control select2js','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('marital_status',trans('messages.marital').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                                    <?php echo e(Form::select('marital_status',['1' => __('messages.marital_1') , '0' => __('messages.marital_0'), '2' => __('Both') ],old('marital_status'),[ 'id' => 'marital' ,'class' =>'form-control select2js','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>
                                                <?php if(!isset($customerdata->id) || $customerdata->id == null): ?>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('password',__('messages.password').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.password'), 'required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>
                                                <?php endif; ?>

                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('contact_number',__('messages.contact_number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                                    <?php echo e(Form::text('contact_number',old('contact_number'),['placeholder' => __('messages.contact_number'),'class' =>'form-control','required', 'readonly' => 'readonly'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('state_id', __('messages.select_name',[ 'select' => __('messages.state') ]), ['class'=>'form-control-label'],false)); ?>

                                                    <br />
                                                    <?php echo e(Form::select('state_id', [
                                        
                                                        'class' => 'select2js form-group state_id',
                                                    
                                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.state') ]),
                                                    ])); ?>


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

                                                <div class="form-group col-md-12">
                                                    <?php echo e(Form::label('address',__('messages.address'), ['class' => 'form-control-label'])); ?>

                                                    <?php echo e(Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>2  , 'placeholder'=> __('messages.address') ])); ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px; border-radius: 5px;">

                                            <h5 class="card-title" style="margin-top: 0; border-bottom: 1px solid gray; padding-bottom: 10px; margin-bottom: 20px;"><?php echo e(__('Education Details')); ?></h5>
                                            <div class="row">


                                                <!-- <div class="form-group col-md-4">
                                                    <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                                    <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required'])); ?>

                                                </div> -->



                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('education',trans('Edu Category').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                                    <?php echo e(Form::select('edu_category_id', [], old('edu_category_id'), [
                                                        'class' => 'select2js form-group q_cat_id',
                                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('Education Category') ]),
                                                        'id' => 'q_cat_id'
                                                    ])); ?>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('qualification_id',trans('Qualification').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                                    <?php echo e(Form::select('qualification_id', [], old('qualification_id'), [
                                                        'class' => 'select2js form-group qual_id',
                                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('Qualification') ]),
                                                        'id' => 'qual_id'
                                                    ])); ?>

                                                </div>


                                            </div>
                                            <h5 class="card-title" style="margin-top: 0; border-bottom: 1px solid gray; padding-bottom: 10px; margin-bottom: 20px;"><?php echo e(__('Jobs Working Details')); ?></h5>
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <?php echo e(Form::label('experience',trans('messages.experience').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                                    <?php echo e(Form::select('experience',['0' => __('messages.exp_0') , '1' => __('messages.exp_1'), '2' => __('messages.exp_2') ,'3' => __('messages.exp_3'), '4' => __('messages.exp_4'), '5' => __('messages.exp_5') ],old('status'),[ 'id' => 'exp' ,'class' =>'form-control select2js','required'])); ?>

                                                    <small class="help-block with-errors text-danger"></small>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('Prefered districts') ]),['class'=>'form-control-label'],false)); ?>

                                                    <br />
                                                    <?php echo e(Form::select('districts[]', [], old('districts'), [
                                                        'class' => 'select2js form-group tax_id',
                                                        'id' =>'tax_id',
                                                        'multiple' => 'multiple',
                                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('districts') ]),
                                                    ])); ?>


                                                </div>
                                                <div class="form-group col-md-12">
                                                    <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('Prefered Job_categories') ]),['class'=>'form-control-label'],false)); ?>

                                                    <br />
                                                    <?php echo e(Form::select('job_categories[]', [], old('job_categories'), [
                                                        'class' => 'select2js form-group jobs_categories',
                                                        'id' =>'jobs_categories',
                                                        'multiple' => 'multiple',
                                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('Job Categories') ]),
                                                    ])); ?>


                                                </div>




                                            </div>
                                        </div>
                                        <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card card-block card-stretch">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo e(__('Resume Preview')); ?></h5>
                                            <?php if(getMediaFileExit($customerdata, 'resume')): ?>
                                            <div class="col-md-2 mb-2">
                                                <?php
                                                $extention = imageExtention(getSingleMedia($customerdata,'resume'));
                                                ?>
                                                <img id="jobs_image_preview" src="<?php echo e(getSingleMedia($customerdata,'resume')); ?>" alt="#" class="attachment-image mt-1">
                                                <a class="text-danger remove-file" href="<?php echo e(route('remove.file', ['id' => $customerdata->id, 'type' => 'resume'])); ?>" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-message='<?php echo e(__("messages.remove_file_msg")); ?>'>
                                                    <i class="ri-close-circle-line"></i>
                                                </a>
                                            </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card card-block p-card">
                                    <div class="profile-box">
                                        <div class="profile-card rounded">
                                            <img src="<?php echo e(getSingleMedia($customerdata,'profile_image')); ?>" alt="profile-bg" class="avatar-100 d-block mx-auto img-fluid mb-3  avatar-rounded">
                                            <h3 class="font-600 text-white text-center mb-5"><?php echo e($customerdata->display_name); ?></h3>
                                        </div>
                                        <div class="pro-content rounded">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                                                    </svg>
                                                </div>
                                                <p class="mb-0 eml"><?php echo e($customerdata->email); ?></p>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z"></path>
                                                    </svg>
                                                </div>
                                                <p class="mb-0"><?php echo e($customerdata->contact_number); ?></p>
                                            </div>
                                            <?php if(!empty($customerdata->address)): ?>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="p-icon mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                </div>
                                                <p class="mb-0"><?php echo e($customerdata->address); ?></p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6">
                                <div class="card card-block card-stretch">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('Compose Message')); ?></h5>
                                        <div class="form-group col-md-12">

                                            <textarea class="form-control textarea" rows="3" placeholder="<?php echo e(__('compose the message')); ?>"></textarea>
                                        </div>
                                        <div class="form-group col-md-12 d-flex justify-content-between">
                                            <button class="btn btn-md btn-primary mb-3"><?php echo e(__('WA Message')); ?></button>
                                            <button class="btn btn-md btn-primary mb-3"><?php echo e(__('Push Notiy')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

    $details = json_decode($customerdata->details, true);

    if (is_null($customerdata->job_categories) && isset($details['job_category'])) {

    $categoriesData = json_decode($details['job_category'], true);

    $catIds = array_map(function($item) {
    return isset($item['id']) ? $item['id'] : null;
    }, $categoriesData);


    $catIds = array_filter($catIds, function($value) {
    return !is_null($value);
    });

    $categoriesIds = implode(',', $catIds);
    }
    else {
    $categoriesData = json_decode($customerdata->job_categories, true);

    $catIds = array_map(function($item) {
    return isset($item['id']) ? $item['id'] : null;
    }, $categoriesData);

    $categoriesIds = implode(',', $catIds);

    }


    if (is_null($customerdata->job_categories) && isset($details['districts'])) {

    $districtData = json_decode($details['districts'], true);

    $dIds = array_map(function($item) {
    return isset($item['id']) ? $item['id'] : null;
    }, $districtData);


    $dIds = array_filter($dIds, function($value) {
    return !is_null($value);
    });

    $idsString = implode(',', $catIds);
    }
    else {
    $data = json_decode($customerdata->job_categories, true);

    $catIds = array_map(function($item) {
    return isset($item['id']) ? $item['id'] : null;
    }, $data);

    $idsString = implode(',', $catIds);
    }

    ?>
    <?php $__env->startSection('bottom_script'); ?>

    <script type="text/javascript">
        (function($) {
            "use strict";

            $(document).ready(function() {
                var districts = "<?php echo e(isset($idsString) ? $idsString : ''); ?>";
                var categories = "<?php echo e(isset($categoriesIds) ? $categoriesIds : ''); ?>";
                var country_id = "<?php echo e(isset($customerdata->country_id) ? $customerdata->country_id : 101); ?>";
                var state_id = "<?php echo e(isset($customerdata->state_id) ? $customerdata->state_id : 35); ?>";
                var district_id = "<?php echo e(isset($customerdata->district_id) ? $customerdata->district_id : 0); ?>";
                var city_id = "<?php echo e(isset($customerdata->city_id) ? $customerdata->city_id : 0); ?>";

                var education = "<?php echo e(isset($customerdata->edu_category_id) ? $customerdata->edu_category_id : 0); ?>";
                var qual_id = "<?php echo e(isset($customerdata->qualification_id) ? $customerdata->qualification_id : 0); ?>";


                educationCategoryName(education);
                qualificationName(education, qual_id);
                stateName(country_id, state_id);

                getDistricts(state_id, districts);
                jobCategories(categories);



                $(document).on('change', '#state_id', function() {
                    var state = $(this).val();
                    $('#district_id').empty();
                    $('#city_id').empty();
                    districtName(state, district_id);
                });

                $(document).on('change', '#district_id', function() {
                    var district = $(this).val();
                    $('#city_id').empty();
                    cityName(district, city_id);
                });

                $(document).on('change', '#q_cat_id', function() {
                    var cat_id = $(this).val();
                    $('#qual_id').empty();
                    qualificationName(cat_id);
                });



            });


            function jobCategories(categories = "") {

                var provider_tax_route = "<?php echo e(route('ajax-list', [ 'type' => 'jobs-category'])); ?>";
                provider_tax_route = provider_tax_route.replace('amp;', '');

                $.ajax({
                    url: provider_tax_route,
                    success: function(result) {
                        $('#jobs_categories').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.tax')])); ?>",
                            data: result.results
                        });
                        if (categories != "") {
                            // alert("value");
                            $('#jobs_categories').val(categories.split(',')).trigger('change');
                        }
                    }
                });

            }


            function getDistricts(state_id, district = "") {


                var provider_tax_route = "<?php echo e(route('ajax-list', [ 'type' => 'district','state_id' =>''])); ?>" + state_id;
                provider_tax_route = provider_tax_route.replace('amp;', '');

                $.ajax({
                    url: provider_tax_route,
                    success: function(result) {
                        $('#tax_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.tax')])); ?>",
                            data: result.results
                        });
                        if (district != "") {

                            $('#tax_id').val(district.split(',')).trigger('change');
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

            function educationCategoryName(education = "") {
                var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'edu_category'])); ?>";
                state_route = state_route.replace('amp;', '');

                $.ajax({
                    url: state_route,
                    success: function(result) {
                        $('#q_cat_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                            data: result.results

                        });
                        if (education != null) {
                            $("#q_cat_id").val(education).trigger('change');
                        }
                    }
                });
            }

            function qualificationName(category, qual = '') {
                var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'qualification', 'category_id' =>''])); ?>" + category;
                state_route = state_route.replace('amp;', '');

                $.ajax({
                    url: state_route,
                    success: function(result) {
                        $('#qual_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                            data: result.results

                        });
                        if (qual != null && qual != '') {

                            $("#qual_id").val(qual).trigger('change');
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
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/jobseeker/view.blade.php ENDPATH**/ ?>