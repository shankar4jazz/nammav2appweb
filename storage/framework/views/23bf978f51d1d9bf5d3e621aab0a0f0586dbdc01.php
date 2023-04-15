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
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h5 class="font-weight-bold"><?php echo e($pageTitle ?? trans('messages.list')); ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <?php echo e(Form::model($payoutdata,['method' => 'POST','route'=>'providerpayout.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'providerpayout'] )); ?>

                    <?php echo e(Form::hidden('provider_id')); ?>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('method',trans('messages.method').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false)); ?>

                                <?php echo e(Form::select('payment_method',['bank' => __('messages.bank') , 'cash' => __('messages.cash'), 'wallet' => __('messages.wallet') ],old('method'),[ 'id' => 'method' ,'class' =>'form-control select2js','required'])); ?>

                            </div>
                            <div class="form-group col-md-12 ">
                                <?php echo e(Form::label('description',__('messages.description'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ])); ?>

                            </div>
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('amount',__('messages.amount'), ['class' => 'form-control-label'])); ?>

                                <?php echo e(Form::number('amount',old('amount'),['placeholder' => __('messages.amount'),'class' =>'form-control', 'required', 'step' => 'any', 'min' => 0, 'max' => $payoutdata->amount ?? 0])); ?>

                            </div>
                        </div>
                    <?php echo e(Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

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
<?php endif; ?>
<?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/providerpayout/create.blade.php ENDPATH**/ ?>