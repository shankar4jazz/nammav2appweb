
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['jobs.destroy', $category->id], 'method' => 'delete','data--submit'=>'category'.$category->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$category->trashed()): ?>
        <?php if($auth_user->can('jobs edit')): ?>
        <a class="mr-2" href="<?php echo e(route('jobs.create',['id' => $category->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.jobs') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?>
        <a class="mr-2" href="<?php echo e(route('jobs.show', $category->id)); ?>"><i class="far fa-eye text-secondary"></i></a>

        <?php if($auth_user->can('jobs delete')): ?>
        <a class="mr-2" href="javascript:void(0)" data--submit="category<?php echo e($category->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.jobs') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.jobs') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $category->trashed()): ?>
        <a href="<?php echo e(route('jobs.action',['id' => $category->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.jobs') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.jobs') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('jobs.action',['id' => $category->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.jobs') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.jobs') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobs/action.blade.php ENDPATH**/ ?>