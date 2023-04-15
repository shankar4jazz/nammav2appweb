
<?php
$auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['booking.destroy', $booking->id], 'method' => 'delete','data--submit'=>'booking'.$booking->id])); ?>

<div class="d-flex justify-content-end align-items-center">
<?php if(!$booking->trashed()): ?>
    <?php if($auth_user->can('booking edit')): ?>
    <a href="<?php echo e(route('booking.edit',$booking->id)); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.booking') ])); ?>"><i class="fas fa-pen text-secondary"></i></a>
    <?php endif; ?>

    <?php if($auth_user->can('booking view')): ?>
    <a class="mx-2" href="<?php echo e(route('booking.show',$booking->id)); ?>" title="<?php echo e(__('messages.view_form_title',['form'=>  __('messages.booking') ])); ?>"><i class="far fa-eye text-secondary"></i></a>
    <?php endif; ?>
    <?php if($auth_user->can('booking delete') && !$booking->trashed()): ?>
    <a class="" href="javascript:void(0)" data--submit="booking<?php echo e($booking->id); ?>" 
        data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.booking') ])); ?>"
        title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.booking') ])); ?>"
        data-message='<?php echo e(__("messages.delete_msg")); ?>'>
        <i class="far fa-trash-alt text-danger "></i>
    </a>
    <?php endif; ?>
<?php endif; ?>
<?php if(auth()->user()->hasAnyRole(['admin']) && $booking->trashed()): ?>
    <a class="mr-2" href="<?php echo e(route('booking.action',['id' => $booking->id, 'type' => 'restore'])); ?>"
        title="<?php echo e(__('messages.restore_form_title',['form' => __('messages.booking') ])); ?>"
        data--submit="confirm_form"
        data--confirmation='true'
        data--ajax='true'
        data-title="<?php echo e(__('messages.restore_form_title',['form'=>  __('messages.booking') ])); ?>"
        data-message='<?php echo e(__("messages.restore_msg")); ?>'
        data-datatable="reload">
        <i class="fas fa-redo text-secondary"></i>
    </a>
    <a href="<?php echo e(route('booking.action',['id' => $booking->id, 'type' => 'forcedelete'])); ?>"
        title="<?php echo e(__('messages.forcedelete_form_title',['form' => __('messages.booking') ])); ?>"
        data--submit="confirm_form"
        data--confirmation='true'
        data--ajax='true'
        data-title="<?php echo e(__('messages.forcedelete_form_title',['form'=>  __('messages.booking') ])); ?>"
        data-message='<?php echo e(__("messages.forcedelete_msg")); ?>'
        data-datatable="reload"
        class="mr-2">
        <i class="far fa-trash-alt text-danger"></i>
    </a>
<?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/booking/action.blade.php ENDPATH**/ ?>