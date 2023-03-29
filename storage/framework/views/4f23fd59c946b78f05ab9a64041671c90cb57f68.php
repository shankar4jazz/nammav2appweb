
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['jobs-categories.destroy', $category->id], 'method' => 'delete','data--submit'=>'category'.$category->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$category->trashed()): ?>
        <?php if($auth_user->can('jobs categories edit')): ?>
        <a class="mr-2" href="<?php echo e(route('jobs-categories.create',['id' => $category->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.jobs_category') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?>

        <?php if($auth_user->can('jobs categories delete')): ?>
        <a class="mr-2" href="javascript:void(0)" data--submit="category<?php echo e($category->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.jobs_category') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.jobs_category') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $category->trashed()): ?>
        <a href="<?php echo e(route('jobs_categories.action',['id' => $category->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.jobs_category') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.jobs_category') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('jobs_categories.action',['id' => $category->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.jobs_category') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.jobs_category') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobscategory/action.blade.php ENDPATH**/ ?>