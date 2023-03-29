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
                                <a href="<?php echo e(route('provider.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php if($auth_user->can('provider list')): ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       
                        <?php echo e(Form::model($providerdata,['method' => 'POST','route'=>'provider.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'provider'] )); ?>

                            <?php echo e(Form::hidden('id')); ?>

                            <?php echo e(Form::hidden('user_type','provider')); ?>

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
                                
                                <?php if(!isset($providerdata->id) || $providerdata->id == null): ?>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('password',__('messages.password').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                        <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('messages.password'), 'required'])); ?>

                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('designation',__('messages.designation'),['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('designation',old('designation'),['placeholder' => __('messages.designation'),'class' =>'form-control'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('providertype_id', __('messages.select_name',[ 'select' => __('messages.providertype') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('providertype_id', [optional($providerdata->providertype)->id => optional($providerdata->providertype)->name], optional($providerdata->providertype)->id, [
                                        'class' => 'select2js form-group providertype',
                                        'required',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.providertype') ]),
                                        'data-ajax--url' => route('ajax-list', ['type' => 'providertype']),
                                    ])); ?>

                                </div>

                                <div class="form-group col-md-4 d-none">
                                    <?php echo e(Form::label('country_id', __('messages.select_name',[ 'select' => __('messages.country') ]),['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('country_id', [optional($providerdata->country)->id => optional($providerdata->country)->name], optional($providerdata->country)->id, [
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

                                    <input type="hidden" name="state_id" value="<?php echo e($providerdata->state_id); ?>"/>
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
                                    <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.tax') ]),['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('tax_id[]', [], old('tax_id'), [
                                        'class' => 'select2js form-group tax_id',
                                        'id' =>'tax_id',
                                        'multiple' => 'multiple',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.tax') ]),
                                    ])); ?>

                                  
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('contact_number',__('messages.contact_number').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('contact_number',old('contact_number'),['placeholder' => __('messages.contact_number'),'class' =>'form-control','required'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required'])); ?>

                                </div>

                                <div class="form-group col-md-4">
                                    <label class="form-control-label" for="profile_image"><?php echo e(__('messages.profile_image')); ?> </label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_image" class="custom-file-input" accept="image/*">
                                        <label class="custom-file-label upload-label"><?php echo e(__('messages.choose_file',['file' =>  __('messages.profile_image') ])); ?></label>
                                    </div>
                                    <span class="selected_file"></span>
                                </div>

                                <?php if(getMediaFileExit($providerdata, 'profile_image')): ?>
                                    <div class="col-md-2 mb-2">
                                        <img id="profile_image_preview" src="<?php echo e(getSingleMedia($providerdata,'profile_image')); ?>" alt="#" class="attachment-image mt-1">
                                            <a class="text-danger remove-file" href="<?php echo e(route('remove.file', ['id' => $providerdata->id, 'type' => 'profile_image'])); ?>"
                                                data--submit="confirm_form"
                                                data--confirmation='true'
                                                data--ajax="true"
                                                data-toggle="tooltip"
                                                title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>'
                                                data-title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>'
                                                data-message='<?php echo e(__("messages.remove_file_msg")); ?>'>
                                                <i class="ri-close-circle-line"></i>
                                            </a>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('address',__('messages.address'), ['class' => 'form-control-label'])); ?>

                                    <?php echo e(Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.address') ])); ?>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <?php echo e(Form::checkbox('is_featured', $providerdata->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_featured' ])); ?>

                                        <label class="custom-control-label" for="is_featured"><?php echo e(__('messages.set_as_featured')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        $data = $providerdata->providerTaxMapping->pluck('tax_id')->implode(',');
    ?>
    
    <?php $__env->startSection('bottom_script'); ?>
        <script type="text/javascript">
            (function($) {
                "use strict";
                $(document).ready(function(){
                    var country_id =  "<?php echo e(isset($providerdata->country_id) ? $providerdata->country_id : 0); ?>";
                    var state_id = "<?php echo e(isset($providerdata->state_id) ? $providerdata->state_id : 0); ?>";
                    var district_id = "<?php echo e(isset($providerdata->district_id) ? $providerdata->district_id : 0); ?>";
                    var city_id = "<?php echo e(isset($providerdata->city_id) ? $providerdata->city_id : 0); ?>";
                  

                    var provider_id =  "<?php echo e(isset($providerdata->id) ? $providerdata->id : ''); ?>";
                    var provider_tax_id =  "<?php echo e(isset($data) ? $data : []); ?>";
                    $('#state_id').attr('disabled',true);
                    getTax(provider_id, provider_tax_id);
                    stateName(country_id, state_id);
                    districtName(state_id, district_id);
                  //  cityName(district_id);
                    $(document).on('change' , '#country_id' , function (){
                        var country = $(this).val();
                        $('#state_id').empty();
                        $('#district_id').empty();
                        $('#city_id').empty();
                        stateName(country);
                    })
                    $(document).on('change' , '#state_id' , function (){
                        var state = $(this).val();
                        $('#district_id').empty();
                        $('#city_id').empty();
                        districtName(state, district_id);
                    })
                    $(document).on('change' , '#district_id' , function (){
                        var district = $(this).val();                       
                        $('#city_id').empty();
                        cityName(district, city_id);
                    })
            
                  
                })
                function stateName(country , state ="" ){
                    var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'state','country_id' =>''])); ?>"+country;
                    state_route = state_route.replace('amp;','');

                    $.ajax({
                        url: state_route,
                        success: function(result){
                            $('#state_id').select2({
                                width: '100%',
                                placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.state')])); ?>",
                                data: result.results
                            });
                            if(state != null){
                                $("#state_id").val(state).trigger('change');
                            }
                        }
                    });
                }

                function districtName(state_id, district = "" ){
                    console.log(district);
                    var state_route = "<?php echo e(route('ajax-list', [ 'type' => 'district','state_id' =>''])); ?>"+state_id;
                    state_route = state_route.replace('amp;','');

                    $.ajax({
                        url: state_route,
                        success: function(result){
                            $('#district_id').select2({
                                width: '100%',
                                placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.district')])); ?>",
                                data: result.results
                            });
                            if(district != null){
                                $("#district_id").val(district).trigger('change');
                            }
                        }
                    });
                }
                function cityName(district , city =""){
                    var city_route = "<?php echo e(route('ajax-list', [ 'type' => 'city' ,'district_id' =>''])); ?>"+district;
                    city_route = city_route.replace('amp;','');

                    $.ajax({
                        url: city_route,
                        success: function(result){
                            $('#city_id').select2({
                                width: '100%',
                                placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.city')])); ?>",
                                data: result.results
                            });
                            if(city != null || city != 0){
                                $("#city_id").val(city).trigger('change');
                            }
                        }
                    });
                }
                function getTax(provider_id,provider_tax_id=""){
                    var provider_tax_route = "<?php echo e(route('ajax-list', [ 'type' => 'provider_tax','provider_id' =>''])); ?>"+provider_id;
                    provider_tax_route = provider_tax_route.replace('amp;','');

                    $.ajax({
                        url: provider_tax_route,
                        success: function(result){
                            $('#tax_id').select2({
                                width: '100%',
                                placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.tax')])); ?>",
                                data: result.results
                            });
                            if(provider_tax_id != ""){
                                $('#tax_id').val(provider_tax_id.split(',')).trigger('change');
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
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/provider/create.blade.php ENDPATH**/ ?>