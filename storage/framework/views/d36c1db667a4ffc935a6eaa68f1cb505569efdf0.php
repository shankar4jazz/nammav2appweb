
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['news.destroy', $subcategory->id], 'method' => 'delete','data--submit'=>'subcategory'.$subcategory->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$subcategory->trashed()): ?>
        <?php if($auth_user->can('news edit')): ?>
        <a class="mr-2" href="<?php echo e(route('news.create',['id' => $subcategory->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.news') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <?php endif; ?>

        <?php if($auth_user->can('news delete')): ?>
        <a class="mr-2" href="javascript:void(0)" data--submit="subcategory<?php echo e($subcategory->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.news') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.news') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $subcategory->trashed()): ?>
        <a href="<?php echo e(route('news.action',['id' => $subcategory->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.news') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.news') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-secondary"></i>
        </a>
        <a href="<?php echo e(route('news.action',['id' => $subcategory->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.news') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.news') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/news/action.blade.php ENDPATH**/ ?>