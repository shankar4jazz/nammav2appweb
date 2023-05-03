<?php echo e(Form::model($settings,['method' => 'POST','route'=>'sendPagePushNotification', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'push_notification'] )); ?>

<?php echo e(Form::hidden('id')); ?>

<?php echo e(Form::hidden('page', $page, ['class' => 'form-control'] )); ?>

<input type="hidden" id="district_name" name="district_name" value="AllTamilNadu">
<div class="row">
    <div class="form-group col-md-12">
        <?php echo e(Form::label('title',trans('messages.title').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false )); ?>

        <?php echo e(Form::text('title',old('title'),['placeholder' => trans('messages.title'),'class' =>'form-control','required'])); ?>

        <small class="help-block with-errors text-danger"></small>
    </div>

    <div class="form-group col-md-12" id="select_district">
        <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('District') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label','data-placeholder' => __('Select District',[ 'select' => __('districts') ])],false)); ?>

        <br />
        <select class="form-control district" name="district_id" id="district_id">
            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option id="<?php echo e($key); ?>" data-type="<?php echo e($value); ?>" value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-group col-md-12" id="select_service">
        <?php echo e(Form::label('name', __('messages.select_name',[ 'select' => __('Select pages') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label','data-placeholder' => __('messages.select_name',[ 'select' => __('messages.tax') ])],false)); ?>

        <br />
        <select class="form-control page-service" name="page">
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
    $(document).ready(function() {
        // var value =  $('.service').find(':selected').attr('data-type');
        // $(document).on('change','.notification_type',function(){
        //     var type =  $(this).val();
        //     if(type == 'service'){
        //         textareaValue(value)
        //         $('#select_service').removeClass('d-none');
        //     }else{
        //         $('#select_service').addClass('d-none');
        //         $('#description').val('')
        //     }
        // });
        var selectElement = document.querySelector('select[name="page"]');

        var selectedOption = selectElement.options[selectElement.selectedIndex];

        if (selectedOption) {
            var selectedText = selectedOption.text;
        } else {
            console.log("No job selected to push notification");
        }
        textareaValue(selectedText);


        
        $(document).on('change', '#district_id', function() {
            var district = $(this).val();
            var district_name = $(this).find('option:selected').text();
            $('#district_name').val(district_name)

        })
        $(document).on('change', '.page-service', function() {
            var selectElement = document.querySelector('select[name="page"]');

            var selectedOption = selectElement.options[selectElement.selectedIndex];

            if (selectedOption) {
                var selectedText = selectedOption.text;
            } else {
                console.log("No job selected to push notification");
            }

            textareaValue(selectedText);

        });
    });

    function textareaValue(value) {
        $('#description').val(value)
    }
</script><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/pushnotification/pages-push-notification.blade.php ENDPATH**/ ?>