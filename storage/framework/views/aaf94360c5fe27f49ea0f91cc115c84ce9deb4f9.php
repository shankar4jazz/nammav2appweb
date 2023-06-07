<?php if (isset($component)) { $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\MasterLayout::class, []); ?>
<?php $component->withName('master-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php echo e(Form::open(['route' => ['provider.destroy', $providerdata->id], 'method' => 'delete','data--submit'=>'provider'.$providerdata->id])); ?>

    <main class="main-area">
        <div class="main-content">
            <div class="container-fluid">
                <?php echo $__env->make('partials._jobs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-block card-stretch">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('messages.booking')); ?></h5>
                                        <div class="table-responsive">
                                            <table class="table data-table mb-0 provider-booking-data">
                                                <thead class="table-color-heading">
                                                    <tr class="text-secondary">
                                                        <th scope="col"><?php echo e(__('messages.booking_id')); ?></th>
                                                        <th scope="col"><?php echo e(__('Title')); ?></th>
                                                        <th scope="col"><?php echo e(__('Payment Type')); ?></th>
                                                        <th scope="col"><?php echo e(__('payment_status')); ?></th>
                                                        <th scope="col"><?php echo e(__('Totol Amount')); ?></th>
                                                        
                                                        <th scope="col"><?php echo e(__('Date Time')); ?></th>
                                                        <th scope="col"><?php echo e(__('TXN ID')); ?></th>
                                                        <th scope="col"><?php echo e(__('Order Id')); ?></th>
                                                        
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
        </div>
    </main>
    <?php echo e(Form::close()); ?>

    <?php $__env->startSection('bottom_script'); ?>
    <script type="text/javascript">
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "",
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'job_title',
                    name: 'job_title'
                },
                {
                    data: 'payment_type',
                    name: 'payment_type'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'date_time',
                    name: 'date_time'
                },
                {
                    data: 'txn_id',
                    name: 'txn_id'
                },
                {
                    data: 'order_id',
                    name: 'order_id'
                }            
                
               
            ]
        });
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/jobspayment/details.blade.php ENDPATH**/ ?>