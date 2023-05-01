
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['service.destroy', $service->id], 'method' => 'delete','data--submit'=>'service'.$service->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$service->trashed()): ?>
        <?php if($auth_user->can('service edit')): ?>
        <a class="mr-2" href="<?php echo e(route('service.create',['id' => $service->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.service') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?>
    
        <?php if($auth_user->can('service delete')): ?>
        <a class="mr-2" href="javascript:void(0)" data--submit="service<?php echo e($service->id); ?>" 
            data--confirmation='true' 
            data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.service') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.service') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
        <?php if(auth()->user()->hasAnyRole(['admin','provider'])): ?>
            <a class="mr-2" href="<?php echo e(route('servicefaq.index',['id' => $service->id])); ?>" title="<?php echo e(__('messages.add_form_title',['form' => __('messages.servicefaq') ])); ?>"><i class="fas fa-plus text-primary"></i></a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $service->trashed()): ?>
        <a href="<?php echo e(route('service.action',['id' => $service->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.service') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.service') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-primary"></i>
        </a>
        <a href="<?php echo e(route('service.action',['id' => $service->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.service') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.service') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/service/action.blade.php ENDPATH**/ ?>