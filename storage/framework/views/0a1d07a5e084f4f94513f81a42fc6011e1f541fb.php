
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['category.destroy', $category->id], 'method' => 'delete','data--submit'=>'category'.$category->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$category->trashed()): ?>
        <?php if($auth_user->can('category edit')): ?>
        <a class="mr-2" href="<?php echo e(route('category.create',['id' => $category->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.category') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?>

        <?php if($auth_user->can('category delete')): ?>
        <a class="mr-2" href="javascript:void(0)" data--submit="category<?php echo e($category->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.category') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.category') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $category->trashed()): ?>
        <a href="<?php echo e(route('category.action',['id' => $category->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.category') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.category') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('category.action',['id' => $category->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.category') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.category') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/category/action.blade.php ENDPATH**/ ?>