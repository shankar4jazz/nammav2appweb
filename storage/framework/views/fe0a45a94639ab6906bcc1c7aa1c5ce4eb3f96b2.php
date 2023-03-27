
<?php
    $auth_user= authSession();
?>
<?php echo e(Form::open(['route' => ['plans.destroy', $plan->id], 'method' => 'delete','data--submit'=>'plan'.$plan->id])); ?>

<div class="d-flex justify-content-end align-items-center">
    <?php if(auth()->user()->hasAnyRole(['admin'])): ?>
        <a class="mr-2" href="<?php echo e(route('plans.create',['id' => $plan->id])); ?>" title="<?php echo e(__('messages.update_form_title',['form' => __('messages.plan') ])); ?>"><i class="fas fa-pen text-primary"></i></a>
        <a class="mr-2" href="javascript:void(0)" data--submit="plan<?php echo e($plan->id); ?>" 
            data--confirmation='true' data-title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.plan') ])); ?>"
            title="<?php echo e(__('messages.delete_form_title',['form'=>  __('messages.plan') ])); ?>"
            data-message='<?php echo e(__("messages.delete_msg")); ?>'>
            <i class="far fa-trash-alt text-danger"></i>
        </a>
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/plan/action.blade.php ENDPATH**/ ?>