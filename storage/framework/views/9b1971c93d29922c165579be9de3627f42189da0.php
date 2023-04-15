
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['coupon.destroy', $coupon->id], 'method' => 'delete','data--submit'=>'coupon'.$coupon->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$coupon->trashed()): ?>
        <?php if($auth_user->can('coupon edit')): ?>
        <a href="<?php echo e(route('coupon.create',['id' => $coupon->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.coupon') ])); ?>"><i class="fas fa-pen text-primary mr-2"></i></a>
        <?php endif; ?>
        <?php if($auth_user->can('coupon delete')): ?>
        <a class=" mr-2" href="javascript:void(0)" data--submit="coupon<?php echo e($coupon->id); ?>" 
            title="<?php echo e(__('messages.delete_form_title',['form' => __('messages.coupon') ])); ?>"
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.coupon') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.coupon') ])); ?>"   
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->user()->hasAnyRole(['admin']) && $coupon->trashed()): ?>
        <a href="<?php echo e(route('coupon.action',['id' => $coupon->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.coupon') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.coupon') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class=" mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('coupon.action',['id' => $coupon->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.coupon') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.coupon') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/coupon/action.blade.php ENDPATH**/ ?>