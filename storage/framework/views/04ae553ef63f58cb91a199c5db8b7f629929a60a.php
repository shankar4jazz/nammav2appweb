
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['tax.destroy', $tax->id], 'method' => 'delete','data--submit'=>'tax'.$tax->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <a class="mr-2" href="<?php echo e(route('tax.create',['id' => $tax->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.tax') ])); ?>"><i class="fas fa-pen text-primary"></i></a>

    <a class="mr-2" href="javascript:void(0)" data--submit="tax<?php echo e($tax->id); ?>" 
        data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.tax') ])); ?>"
        title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.tax') ])); ?>"
        data-message='<?php echo e(__("messages.delete_msg")); ?>'>
        <i class="far fa-trash-alt text-danger"></i>
    </a>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/taxes/action.blade.php ENDPATH**/ ?>