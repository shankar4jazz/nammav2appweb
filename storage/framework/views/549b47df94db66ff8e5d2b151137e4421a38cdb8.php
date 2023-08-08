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
                            <?php if($auth_user->can('provideraddress list')): ?>
                                <a href="<?php echo e(route('provideraddress.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($provideraddress ?? '',['method' => 'POST','route'=>'provideraddress.store', 'data-toggle'=>"validator" ,'id'=>'provideraddress'] )); ?>

                            <?php echo e(Form::hidden('id')); ?>

                            <div class="row">
                                <?php if(auth()->user()->hasAnyRole(['admin','demo_admin'])): ?>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('provider_id', __('messages.select_name',[ 'select' => __('messages.providers') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                        <br />
                                        <?php echo e(Form::select('provider_id', [optional($provideraddress->providers)->id => optional($provideraddress->providers)->display_name], optional($provideraddress->providers)->id, [
                                            'class' => 'select2js form-group providers',
                                            'required',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.providers') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'provider']),
                                        ])); ?>

                                    </div>
                                <?php endif; ?>
                                
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('latitude',__('messages.latitude').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::number('latitude',old('latitude'), [ 'placeholder' => '00.0000','class' =>'form-control','required','step'=>'any'])); ?>

                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('longitude',__('messages.longitude').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::number('longitude',old('longitude'), [ 'placeholder' => '00.0000','class' =>'form-control','required','step'=>'any'])); ?>

                                </div>
                                
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required'])); ?>

                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('address',__('messages.address').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <?php echo e(Form::textarea('address', null, ['class'=>"form-control textarea" , 'required','rows'=>3  , 'placeholder'=> __('messages.address') ])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>  
                            </div>
                            <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/provideraddress/create.blade.php ENDPATH**/ ?>