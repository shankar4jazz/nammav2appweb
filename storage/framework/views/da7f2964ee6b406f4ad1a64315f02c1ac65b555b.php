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
                            <a href="<?php echo e(route('jobs-categories.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($categorydata,['method' => 'POST','route'=>'jobs-categories.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'category'] )); ?>

                        <?php echo e(Form::hidden('id')); ?>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('name',trans('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('name',old('name'),['placeholder' => trans('messages.name'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('tamil_name',trans('messages.tamil_name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                <?php echo e(Form::text('tamil_name',old('tamil_name'),['placeholder' => trans('messages.tamil_name'),'class' =>'form-control','required'])); ?>

                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('color',trans('messages.color'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::color('color',null, ['placeholder' => trans('messages.color'),'class' =>'form-control' ,'id' => 'color'])); ?>

                            </div>

                            <div class="form-group col-md-4">
                                <?php echo e(Form::label('status',trans('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required'])); ?>

                            </div>

                            <div class="form-group col-md-4">
                                <label class="form-control-label" for="jobs_category_image"><?php echo e(__('messages.image')); ?> </label>
                                <div class="custom-file">
                                    <input type="file" name="jobs_category_image" class="custom-file-input" onchange="preview()" accept="image/*">
                                    <label class="custom-file-label upload-label"><?php echo e(__('messages.choose_file',['file' =>  __('messages.image') ])); ?></label>
                                </div>
                            </div>
                            <?php if(getMediaFileExit($categorydata, 'jobs_category_image')): ?>
                            <div class="col-md-2 mb-2">
                                <?php
                                $extention = imageExtention(getSingleMedia($categorydata, 'jobs_category_image'));
                                ?>
                                <img id="jobs_category_image_preview" src="<?php echo e(getSingleMedia($categorydata,'jobs_category_image')); ?>" alt="#" class="attachment-image mt-1" style="background-color:<?php echo e($extention == 'svg' ? $categorydata->color : ''); ?>">
                                <a class="text-danger remove-file" href="<?php echo e(route('remove.file', ['id' => $categorydata->id, 'type' => 'jobs_category_image'])); ?>" data--submit="confirm_form" data--confirmation='true' data--ajax="true" title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-title='<?php echo e(__("messages.remove_file_title" , ["name" =>  __("messages.image") ])); ?>' data-message='<?php echo e(__("messages.remove_file_msg")); ?>'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <img id="jobs_category_image_preview" src="" width="150px" />
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('description',trans('messages.description'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ])); ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <!-- <input type="checkbox" name="is_featured" value="1" class="custom-control-input" id="is_featured"> -->
                                    <?php echo e(Form::checkbox('is_featured', $categorydata->is_featured, null, ['class' => 'custom-control-input' , 'id' => 'is_featured' ])); ?>

                                    <label class="custom-control-label" for="is_featured"><?php echo e(__('messages.set_as_featured')); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function preview() {
            category_image_preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobscategory/create.blade.php ENDPATH**/ ?>