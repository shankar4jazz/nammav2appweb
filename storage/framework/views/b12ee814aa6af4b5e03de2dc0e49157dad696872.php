<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs nav-fill tabslink payment-view-tabs" id="tab-text" role="tablist">
                <li class="nav-item payment-link">
                    <a href="javascript:void(0)" data-href="<?php echo e(route('booking_layout_page',$bookingdata->id)); ?>?tabpage=info" data-target=".payment_paste_here" data-toggle="tabajax" class="nav-link  <?php echo e($tabpage=='info'?'active':''); ?>" rel="tooltip"> <?php echo e(__('messages.info')); ?></a>
                </li>
                <li class="nav-item payment-link">
                    <a href="javascript:void(0)" data-href="<?php echo e(route('booking_layout_page',$bookingdata->id)); ?>?tabpage=status" data-target=".payment_paste_here" data-toggle="tabajax" class="nav-link  <?php echo e($tabpage=='status'?'active':''); ?>" rel="tooltip"> <?php echo e(__('messages.status')); ?></a>
                </li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent-1">
                        <div class="tab-pane active p-1">
                            <div class="payment_paste_here"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php $__env->startSection('bottom_script'); ?>
    <script>
        $(document).ready(function(event) {
            var $this = $('.payment-link').find('a.active');
            loadurl = '<?php echo e(route('booking_layout_page',$bookingdata->id)); ?>?tabpage=<?php echo e($tabpage); ?>';
            targ = $this.attr('data-target');
            
            id = this.id || '';

            $.post(loadurl, {
                '_token': $('meta[name=csrf-token]').attr('content')
            }, function(data) {
                $(targ).html(data);
            });

            $this.tab('show');
            return false;
        });
         $('.payment_paste_here').on('change','.booking-Status',function(){
            $.post("<?php echo e(route('bookingStatus.update')); ?>", {
                '_token': $('meta[name=csrf-token]').attr('content'), 
                bookingId:"<?php echo e(request()->booking); ?>",
                status: $(this).val(),
                type: $(this).attr("type"),
            }, function(data) {
             window.location.reload();
            });
        });
        

    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/booking/view.blade.php ENDPATH**/ ?>