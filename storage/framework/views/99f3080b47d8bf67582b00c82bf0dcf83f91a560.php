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
                                <a href="<?php echo e(route('providertype.index')); ?>" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> <?php echo e(__('messages.back')); ?></a>
                            <?php if($auth_user->can('providertype list')): ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::model($providertypedata ?? '',['method' => 'POST','route'=>'providertype.store', 'data-toggle'=>"validator" ,'id'=>'providertype'] )); ?>

                            <?php echo e(Form::hidden('id')); ?>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('name',__('messages.name').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

                                    <?php echo e(Form::text('name',old('name'),['placeholder' => __('messages.name'),'class' =>'form-control'])); ?>

                                    <small class="help-block with-errors text-danger"></small>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('commission',__('messages.commission').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

                                    <?php echo e(Form::number('commission',old('commission'), [ 'min' => 0, 'step' => 'any' , 'placeholder' => __('messages.commission'),'class' =>'form-control'])); ?>

                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('type', __('messages.select_name',[ 'select' => __('messages.type') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <br />
                                    <?php echo e(Form::select('type',['percent' => __('messages.percent') , 'fixed' => __('messages.fixed') ],old('type'),[ 'id' => 'type' ,'class' =>'form-control select2js','required'])); ?>

                                    <span class="text-danger"><?php echo e(__('messages.hint')); ?></span>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('status',__('messages.status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                    <?php echo e(Form::select('status',['1' => __('messages.active') , '0' => __('messages.inactive') ],old('status'),[ 'id' => 'role' ,'class' =>'form-control select2js','required'])); ?>

                                </div>
                            </div>
                            <?php echo e(Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/providertype/create.blade.php ENDPATH**/ ?>