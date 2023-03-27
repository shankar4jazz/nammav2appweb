<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete','data--submit'=>'user'.$user->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$user->trashed()): ?>
        <?php if($auth_user->can('user view')): ?>
        <a class="mr-2" href="<?php echo e(route('user.show',$user->id)); ?>"><i class="far fa-eye text-secondary"></i></a>
        <?php endif; ?>
        <?php if($auth_user->can('user edit')): ?>
        <a class="mr-2" href="<?php echo e(route('user.create',['id' => $user->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.user') ])); ?>"><i class="fas fa-pen text-primary "></i></a>
        <?php endif; ?>
        <?php if($auth_user->can('user delete')): ?>
        <a class="mr-2 text-danger" href="javascript:void(0)" data--submit="user<?php echo e($user->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.user') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.user') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $user->trashed()): ?>
        <a href="<?php echo e(route('user.action',['id' => $user->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.user') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.user') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class=" mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('user.action',['id' => $user->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.user') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.user') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/customer/action.blade.php ENDPATH**/ ?>