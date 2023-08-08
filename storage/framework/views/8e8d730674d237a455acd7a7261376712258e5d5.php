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
                            <a href="<?php echo e(route('service.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php if($auth_user->can('service list')): ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($servicedata,['method' => 'POST','route'=>'service.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'service'] )); ?>

                        <?php echo e(Form::hidden('id')); ?>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name',__('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('tamil_name',trans('messages.tamil_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('tamil_name',old('tamil_name'),['placeholder' => trans('messages.tamil_name'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.category') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('category_id', [optional($servicedata->category)->id => optional($servicedata->category)->name], optional($servicedata->category)->id, [
                                            'class' => 'select2js form-group category',
                                            'required',
                                            'id' => 'category_id',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.category') ]),
                                            'data-ajax--url' => str_replace('http:', 'https:',route('ajax-list', ['type' => 'category'])),
                                        ])); ?>


                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('subcategory_id', __('messages.select_name',[ 'select' => __('messages.subcategory') ]),['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('subcategory_id', [], [
                                        'class' => 'select2js form-group subcategory_id',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.subcategory') ]),
                                    ])); ?>

                            </div>

                            <?php if(auth()->user()->hasAnyRole(['admin','demo_admin'])): ?>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.provider') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('provider_id', [ optional($servicedata->providers)->id => optional($servicedata->providers)->display_name ], optional($servicedata->providers)->id, [
                                            'class' => 'select2js form-group',
                                            'id' => 'provider_id',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.provider') ]),
                                            'data-ajax--url' => str_replace('http:', 'https:', route('ajax-list', ['type' => 'provider'])),
                                        ])); ?>

                            </div>
                            <?php endif; ?>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.provider_address') ]),['class'=>'form-control-label'],false)); ?>

                                <br />
                                <?php echo e(Form::select('provider_address_id[]', [], old('provider_address_id'), [
                                        'class' => 'select2js form-group provider_address_id',
                                        'id' =>'provider_address_id',
                                        'multiple' => 'multiple',
                                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.provider_address') ]),
                                    ])); ?>

                                <a href="<?php echo e(route('provideraddress.create')); ?>" class=""><i class="fa fa-plus-circle mt-2"></i> <?php echo e(trans('messages.add_form_title',['form' => trans('messages.provider_address')  ])); ?></a>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('type',__('messages.price_type').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('type',['fixed' => __('messages.fixed') , 'hourly' => __('messages.hourly'), 'free' => __('messages.free') ],old('status'),[ 'class' =>'form-control select2js','required' ,'id'=>'price_type'])); ?>

                            </div>
                            <div class="form-group col-md-4" id="price_div">
                                <?php echo e(Form::label('price',__('messages.price').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::number('price',null, [ 'min' => 1, 'step' => 'any' , 'placeholder' => __('messages.price'),'class' =>'form-control', 'required','id' => 'price' ])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4" id="discount_div">
                                <?php echo e(Form::label('discount',__('messages.discount').' %', ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::number('discount',null, [ 'min' => 0, 'step' => 'any' , 'id' =>'discount','placeholder' => __('messages.discount'),'class' =>'form-control'])); ?>

                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-control-label" for="service_attachment"><?php echo e(__('messages.image')); ?> <span class="text-danger">*</span> </label>
                                <div class="custom-file">
                                    <input type="file" name="service_attachment[]" class="custom-file-input" data-file-error="<?php echo e(__('messages.files_not_allowed')); ?>" multiple>
                                    <label class="custom-file-label upload-label"><?php echo e(__('messages.choose_file',['file' =>  __('messages.attachments') ])); ?></label>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('duration',__('messages.duration').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::text('duration',old('duration'),['placeholder' => __('messages.duration'),'class' =>'form-control min-datetimepicker-time','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'class' =>'form-control select2js','required'])); ?>

                            </div>
                        </div>

                        <div class="row service_attachment_div">
                            <div class="col-md-12">
                                <?php if(getMediaFileExit($servicedata, 'service_attachment')): ?>
                                <?php
                                $attchments = $servicedata->getMedia('service_attachment');
                                $file_extention = config('constant.IMAGE_EXTENTIONS');
                                ?>
                                <div class="border-left-2">
                                    <p class="ml-2"><b><?php echo e(__('messages.attached_files')); ?></b></p>
                                    <div class="ml-2 my-3">
                                        <div class="row">
                                            <?php $__currentLoopData = $attchments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attchment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $extention = in_array(strtolower(imageExtention($attchment->getFullUrl())), $file_extention);
                                            ?>

                                            <div class="col-md-2 pr-10 text-center galary file-gallary-<?php echo e($servicedata->id); ?>" data-gallery=".file-gallary-<?php echo e($servicedata->id); ?>" id="service_attachment_preview_<?php echo e($attchment->id); ?>">
                                                <?php if($extention): ?>
                                                <a id="attachment_files" href="<?php echo e($attchment->getFullUrl()); ?>" class="list-group-item-action attachment-list" target="_blank">
                                                    <img src="<?php echo e($attchment->getFullUrl()); ?>" class="attachment-image" alt="">
                                                </a>
                                                <?php else: ?>
                                                <a id="attachment_files" class="video list-group-item-action attachment-list" href="<?php echo e($attchment->getFullUrl()); ?>">
                                                    <img src="<?php echo e(asset('images/file.png')); ?>" class="attachment-file">
                                                </a>
                                                <?php endif; ?>
                                                <a class="text-danger remove-file" href="<?php echo e(route('remove.file', ['id' => $attchment->id, 'type' => 'service_attachment'])); ?>" data--submit="confirm_form" data--confirmation='true' data--ajax="true" data-toggle="tooltip" title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.attachments") ] )); ?>' data-title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.attachments") ] )); ?>' data-message='<?php echo e(__("messages.remove_file_msg")); ?>'>
                                                    <i class="ri-close-circle-line"></i>
                                                </a>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('description',__('messages.description'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ])); ?>

                            </div>


                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <?php echo e(Form::checkbox('is_featured', $servicedata->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_featured' ])); ?>

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
    $data = $servicedata->providerServiceAddress->pluck('provider_address_id')->implode(',');
    ?>
    <?php $__env->startSection('bottom_script'); ?>
    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {
                var provider_id = "<?php echo e(isset($servicedata->provider_id) ? $servicedata->provider_id : ''); ?>";
                var provider_address_id = "<?php echo e(isset($data) ? $data : []); ?>";

                var category_id = "<?php echo e(isset($servicedata->category_id) ? $servicedata->category_id : ''); ?>";
                var subcategory_id = "<?php echo e(isset($servicedata->subcategory_id) ? $servicedata->subcategory_id : ''); ?>";

                var price_type = "<?php echo e(isset($servicedata->type) ? $servicedata->type : ''); ?>";

                providerAddress(provider_id, provider_address_id)
                getSubCategory(category_id, subcategory_id)
                priceformat(price_type)

                $(document).on('change', '#provider_id', function() {
                    var provider_id = $(this).val();
                    $('#provider_address_id').empty();
                    providerAddress(provider_id, provider_address_id);
                })
                $(document).on('change', '#category_id', function() {
                    var category_id = $(this).val();
                    $('#subcategory_id').empty();
                    getSubCategory(category_id, subcategory_id);
                })
                $(document).on('change', '#price_type', function() {
                    var price_type = $(this).val();
                    priceformat(price_type);
                })


                $('.galary').each(function(index, value) {
                    let galleryClass = $(value).attr('data-gallery');
                    $(galleryClass).magnificPopup({
                        delegate: 'a#attachment_files',
                        type: 'image',
                        gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                        },
                        callbacks: {
                            elementParse: function(item) {
                                if (item.el[0].className.includes('video')) {
                                    item.type = 'iframe',
                                        item.iframe = {
                                            markup: '<div class="mfp-iframe-scaler">' +
                                                '<div class="mfp-close"></div>' +
                                                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                                                '<div class="mfp-title">Some caption</div>' +
                                                '</div>'
                                        }
                                } else {
                                    item.type = 'image',
                                        item.tLoading = 'Loading image #%curr%...',
                                        item.mainClass = 'mfp-img-mobile',
                                        item.image = {
                                            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
                                        }
                                }
                            }
                        }
                    })
                })
            })

            function providerAddress(provider_id, provider_address_id = "") {
                var provider_address_route = "<?php echo e(route('ajax-list', [ 'type' => 'provider_address','provider_id' =>''])); ?>" + provider_id;
                provider_address_route = provider_address_route.replace('amp;', '');
				provider_address_route = provider_address_route.replace(/^http:/, 'https:');
                $.ajax({
                    url: provider_address_route,
                    success: function(result) {
                        $('#provider_address_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.provider_address')])); ?>",
                            data: result.results
                        });
                        if (provider_address_id != "") {
                            $('#provider_address_id').val(provider_address_id.split(',')).trigger('change');
                        }
                    }
                });
            }

            function getSubCategory(category_id, subcategory_id = "") {
                
                var get_subcategory_list = "<?php echo e(route('ajax-list', [ 'type' => 'subcategory_list','category_id' =>''])); ?>" + category_id;
                get_subcategory_list = get_subcategory_list.replace('amp;', '');
   get_subcategory_list = get_subcategory_list.replace('amp;', '');
                get_subcategory_list = get_subcategory_list.replace(/^http:/, 'https:');

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        $('#subcategory_id').select2({
                            width: '100%',
                            placeholder: "<?php echo e(trans('messages.select_name',['select' => trans('messages.subcategory')])); ?>",
                            data: result.results
                        });
                        if (subcategory_id != "") {
                            $('#subcategory_id').val(subcategory_id).trigger('change');
                        }
                    }
                });
            }

            function priceformat(value) {
                if (value == 'free') {
                    $('#price').val(0);
                    $('#price').attr("readonly", true)

                    $('#discount').val(0);
                    $('#discount').attr("readonly", true)

                }
            }
        })(jQuery);
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/service/create.blade.php ENDPATH**/ ?>