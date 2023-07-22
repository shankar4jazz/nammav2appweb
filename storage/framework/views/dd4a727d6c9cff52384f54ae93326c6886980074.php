
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['slider.destroy', $slider->id], 'method' => 'delete','data--submit'=>'slider'.$slider->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(!$slider->trashed()): ?>
    <?php if($auth_user->can('slider edit')): ?>
        <a class=" mr-2" href="<?php echo e(route('slider.create',['id' => $slider->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.slider') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
    <?php endif; ?>
    <?php if($auth_user->can('slider edit')): ?>
        <a class="mr-2 text-danger" href="javascript:void(0)" data--submit="slider<?php echo e($slider->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.slider') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.slider') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt"></i>
        </a>
    <?php endif; ?>

    <?php endif; ?>
    <?php if(auth()->user()->hasAnyRole(['admin']) && $slider->trashed()): ?>
        <a href="<?php echo e(route('slider.action',['id' => $slider->id, 'type' => 'restore'])); ?>"
            title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.slider') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.slider') ])); ?>"
            data-message='<?php echo e(__("messages.restore_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="fas fa-redo text-primary"></i>
        </a>
        <a href="<?php echo e(route('slider.action',['id' => $slider->id, 'type' => 'forcedelete'])); ?>"
            title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.slider') ])); ?>"
            data--submit="confirm_form"
            data--confirmation='true'
            data--ajax='true'
            data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.slider') ])); ?>"
            data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
            data-datatable="reload"
            class="mr-2">
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/slider/action.blade.php ENDPATH**/ ?>