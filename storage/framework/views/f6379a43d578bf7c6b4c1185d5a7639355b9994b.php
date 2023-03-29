
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['providertype.destroy', $providertype->id], 'method' => 'delete','data--submit'=>'providertype'.$providertype->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$providertype->trashed()): ?>
    <?php if($auth_user->can('providertype edit')): ?>
        <a class="mr-2" href="<?php echo e(route('providertype.create',['id' => $providertype->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.providertype') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
    <?php endif; ?>
    <?php if($auth_user->can('providertype delete')): ?>
        <a class="mr-2 text-danger" href="javascript:void(0)" data--submit="providertype<?php echo e($providertype->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.providertype') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.providertype') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt"></i>
        </a>
    <?php endif; ?>

    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $providertype->trashed()): ?>
        <a class="mr-2" href="<?php echo e(route('providertype.action',['id' => $providertype->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.providertype') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.providertype') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('providertype.action',['id' => $providertype->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.providertype') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.providertype') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/providertype/action.blade.php ENDPATH**/ ?>