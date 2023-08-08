
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['handyman.destroy', $handyman->id], 'method' => 'delete','data--submit'=>'handyman'.$handyman->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$handyman->trashed()): ?>
        <?php if($auth_user->can('handyman edit')): ?>
        <a class="mr-2" href="<?php echo e(route('handyman.create',['id' => $handyman->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.handyman') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?>

        <?php if($auth_user->can('handyman delete')): ?>
        <a class="mr-2 text-danger" href="javascript:void(0)" data--submit="handyman<?php echo e($handyman->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.handyman') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.handyman') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $handyman->trashed()): ?>
        <a href="<?php echo e(route('handyman.action',['id' => $handyman->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.handyman') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.handyman') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('handyman.action',['id' => $handyman->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.handyman') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.handyman') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/handyman/action.blade.php ENDPATH**/ ?>