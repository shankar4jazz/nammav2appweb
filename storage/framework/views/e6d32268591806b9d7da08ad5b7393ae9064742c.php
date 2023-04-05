
<?php echo e(Form::model($settings,['method' => 'POST','route'=>'sendPushNotification', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'push_notification'] )); ?>

    <?php echo e(Form::hidden('id')); ?>

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

            <?php echo e(Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control','required'])); ?>

            <small class="help-block with-errors text-danger"></small>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('type',trans('messages.type').' <span class="text-danger">*</span>',['class'=>'form-control-label '],false)); ?>

            <?php echo e(Form::select('type',['alldata' => __('messages.all') , 'service' => __('messages.service') ],old('type'),[ 'id' => 'type' ,'class' =>'form-control select2js notification_type','required'])); ?>

        </div>
        <div class="form-group col-md-12 d-none" id="select_service">
            <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('messages.service') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label','data-placeholder' => __('messages.select_name',[ 'select' => __('messages.tax') ])],false)); ?>

            <br />
            <select class="form-control service" name="service_id">
             <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option id="<?php echo e($key); ?>" data-type="<?php echo e($value); ?>" value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description',trans('messages.description').' <span class="text-danger">*</span>', ['class' => 'form-control-label'],false)); ?>

            <?php echo e(Form::textarea('description', null, ['class'=>"form-control textarea" ,'id'=>'description','rows'=>3  , 'required','placeholder'=> __('messages.description') ])); ?>

        </div>
    </div>
    <?php echo e(Form::submit( trans('messages.save'), ['class'=>'btn btn-md btn-primary float-right'])); ?>

<?php echo e(Form::close()); ?>

<script>
    $(document).ready(function (){
        var value =  $('.service').find(':selected').attr('data-type');
        $(document).on('change','.notification_type',function(){
            var type =  $(this).val();
            if(type == 'service'){
                textareaValue(value)
                $('#select_service').removeClass('d-none');
            }else{
                $('#select_service').addClass('d-none');
                $('#description').val('')
            }
        });
        $(document).on('change','.service',function(){
            var value =  $(this).find(':selected').attr('data-type');
            textareaValue(value)
            
        });
    });
    function textareaValue(value){
        $('#description').val(value)
    }
</script>
               <?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/setting/push-notification-setting.blade.php ENDPATH**/ ?>