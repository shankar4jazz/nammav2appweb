
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['provideraddress.destroy', $provideraddress->id], 'method' => 'delete','data--submit'=>'providertype'.$provideraddress->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if($auth_user->can('provideraddress edit')): ?>
    <a class="mr-2" href="<?php echo e(route('provideraddress.create',['id' => $provideraddress->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.provider_address') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
    <?php endif; ?>
    <?php if($auth_user->can('provideraddress delete')): ?>
    <a class="mr-2 text-danger" href="javascript:void(0)" data--submit="providertype<?php echo e($provideraddress->id); ?>" 
        data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.provider_address') ])); ?>"
        title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.address') ])); ?>"
        data-message='<?php echo e(__("messages.delete_msg")); ?>'>
        <i class="far fa-trash-alt"></i>
    </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/provideraddress/action.blade.php ENDPATH**/ ?>