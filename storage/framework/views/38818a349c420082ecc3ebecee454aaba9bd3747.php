<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch">
                        <div class="card-body">
                        <h5 class="card-title"><?php echo e(__('messages.earning')); ?></h5>
                            <div class="table-responsive">
                                <table class="table handydata-table mb-0">
                                    <thead class="table-color-heading">
                                        <tr class="text-secondary">
                                        <th scope="col"><?php echo e(__('messages.handyman')); ?></th>
                                        <th scope="col"><?php echo e(__('messages.commission')); ?></th>
                                        <th scope="col"><?php echo e(__('messages.booking')); ?></th>
                                        <th scope="col"><?php echo e(__('messages.total_amount')); ?></th>
                                        <th scope="col"><?php echo e(__('messages.total_earning')); ?></th>
                                        <th scope="col"><?php echo e(__('messages.action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('bottom_script'); ?>
<script type="text/javascript">
var table = $('.handydata-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "<?php echo e(route('handymanEarningData')); ?>",
    columns: [
        {data: 'handyman_name', name: 'handyman_name'},
        {data: 'commission', name: 'commission'},
        {data: 'total_bookings', name: 'total_bookings'},
        {data: 'total', name: 'total'},
        {data: 'total_earning', name: 'total_earning'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});
</script>
<?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/earning/handyman.blade.php ENDPATH**/ ?>