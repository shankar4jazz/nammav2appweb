<div class="card-header-border card-header">
    <div class="card-notify-box">
        <h4 class="text-center notify-title">
            <?php echo e(__('messages.all_notifications')); ?>

        </h4>
        <small class="badge badge-light float-right notification_count notification_tag"> <?php echo e($all_unread_count); ?></small>
    </div>  
    <div class="read-notify-box">
        <h6 class="text-sm text-muted m-0"><span class="notification_count"><?php echo e(__('messages.you_unread_notification',['number' => $all_unread_count  ])); ?></span>
            <?php if($all_unread_count > 0 ): ?>
                <a href="#" data-type="markas_read" class="notifyList pull-right" ><span><?php echo e(__('messages.mark_all_as_read')); ?></span></a>
            <?php endif; ?>
        </h6>
    </div> 
</div>

<div class="card-body overflow-auto card-header-border p-0 card-body-list">
    <ul class="dropdown-menu-1 overflow-y-auto list-style-1 mb-0 notification-height">
        <?php if(isset($notifications) && count($notifications) > 0): ?>
            <?php $__currentLoopData = $notifications->sortByDesc('created_at')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="dropdown-item-1 float-none p-3 <?php echo e($notification->read_at ? '':'notify-list-bg'); ?> ">
                    <a href="<?php echo e(route('booking.show', $notification->data['id'])); ?>" class="">
                    <div class="list-item d-flex justify-content-start align-items-start">
                        <div class="list-style-detail ml-2 mr-2">
                            <h6 class="font-weight-bold mb-1"># <?php echo e($notification->data['id'] ." ". str_replace("_"," ",ucfirst($notification->data['type']))); ?></h6>
                            <p class="mb-1">
                                <small class="text-secondary"><?php echo e(isset($notification->data['message']) ? $notification->data['message'] : __('messages.booking')); ?></small>
                            </p>
                            <p class="m-0">
                                <small class="text-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondary mr-1" width="15" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <?php echo e(timeAgoFormate($notification->created_at)); ?>

                                </small>
                            </p>
                        </div>
                    </div>                                                
                </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <li class="dropdown-item-1 float-none p-3">
                <div class="list-item d-flex justify-content-center align-items-center">
                    <div class="list-style-detail ml-2 mr-2">
                    <h6 class="font-weight-bold"><?php echo e(__('messages.no_notification')); ?></h6>
                    <p class="mb-0"></p>
                    </div>
                </div>
            </li>
        <?php endif; ?>
    </ul>
</div>
<?php if(isset($notifications) && count($notifications) > 0): ?>
<div class="card-footer text-muted p-3 text-center ">
    <a href="<?php echo e(route('notification.index')); ?>" class="mb-0 btn-link btn-link-hover font-weight-bold view-all-btn"><?php echo e(__('messages.view_all')); ?></a>
</div>
<?php endif; ?>
<script>
     $('.notifyList').on('click',function(){
        notificationList($(this).attr('data-type'));
    });

    $(document).on('click','.notification_data',function(event){
        event.stopPropagation();
    })

    function notificationList(type=''){
        var url = "<?php echo e(route('notification.list')); ?>";
        $.ajax({
            type: 'get',
            url: url,
            data: {'type':type},
            success: function(res){

                $('.notification_data').html(res.data);
                getNotificationCounts();
                if(res.type == "markas_read"){
                    notificationList();
                }
                $('.notify_count').removeClass('notification_tag').text('');
            }
        });
    }

    function getNotificationCounts(){
        var url = "<?php echo e(route('notification.counts')); ?>";
        $.ajax({
            type: 'get',
            url: url,
            success: function(res){
                if(res.counts > 0){
                    $('.notify_count').addClass('notification_tag').text(res.counts);
                    setNotification(res.counts);
                    $('.notification_list span.dots').addClass('d-none')
                    $('.notify_count').removeClass('d-none')
                }else{
                    $('.notify_count').addClass('d-none')
                    $('.notification_list span.dots').removeClass('d-none')
                }

                if(res.counts <= 0 && res.unread_total_count > 0){
                    $('.notification_list span.dots').removeClass('d-none')
                }else{
                    $('.notification_list span.dots').addClass('d-none')
                }
            }
        });
    }
</script><?php /**PATH /var/www/vhosts/jobs7.in/newsapp.jobs7.in/resources/views/notification/list.blade.php ENDPATH**/ ?>