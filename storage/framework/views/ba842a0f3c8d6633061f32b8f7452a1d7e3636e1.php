<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php echo $__env->make('partials._provider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs nav-fill tabslink" id="tab-text" role="tablist">
                <li class="nav-item payment-link">
                    <a href="javascript:void(0)" data-href="<?php echo e(route('provider_detail_pages')); ?>?tabpage=all-plan&providerid=<?php echo e(request()->service); ?>" data-target=".payment_paste_here" data-toggle="tabajax" class="nav-link  <?php echo e($tabpage=='all-plan'?'active':''); ?>" rel="tooltip"> <?php echo e(__('messages.all')); ?></a>
                </li>
                <li class="nav-item payment-link">
                    <a href="javascript:void(0)" data-href="<?php echo e(route('provider_detail_pages')); ?>?tabpage=subscribe-plan&providerid=<?php echo e(request()->service); ?>" data-target=".payment_paste_here" data-toggle="tabajax" class="nav-link  <?php echo e($tabpage=='subscribe-plan'?'active':''); ?>" rel="tooltip"> <?php echo e(__('messages.service_subscribe')); ?></a>
                    
                </li>
                <li class="nav-item payment-link">
                    <a href="javascript:void(0)" data-href="<?php echo e(route('provider_detail_pages')); ?>?tabpage=unsubscribe-plan&providerid=<?php echo e(request()->service); ?>" data-target=".payment_paste_here" data-toggle="tabajax" class="nav-link  <?php echo e($tabpage=='unsubscribe-plan'?'active':''); ?>" rel="tooltip"> <?php echo e(__('messages.service_unsubscribe')); ?></a>
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
    <?php $__env->startSection('bottom_script'); ?>
    <script>
        $(document).ready(function(event) {
            var $this = $('.payment-link').find('a.active');
            loadurl = '<?php echo e(route('provider_detail_pages')); ?>?tabpage=<?php echo e($tabpage); ?>&providerid=<?php echo e(request()->service); ?>';

            targ = $this.attr('data-target');

            id = this.id || '';

            $.get(loadurl, {
                '_token': $('meta[name=csrf-token]').attr('content'),
                'providerId': "<?php echo e($providerdata->id); ?>"
            }, function(data) {
                $(targ).html(data);
            });

            $this.tab('show');
            return false;
        });
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/service/view.blade.php ENDPATH**/ ?>