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
                                                        <th scope="col"><?php echo e(__('name')); ?></th>
                                                        <th scope="col"><?php echo e(__('Mobile Number')); ?></th>  
                                                        <th scope="col"><?php echo e(__('type')); ?></th>
                                                        <th scope="col"><?php echo e(__('message')); ?></th>
                                                        <th scope="col"><?php echo e(__('date time')); ?></th>                                   
                                                                                                           
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
                    data: 'jobseeker_name',
                    name: 'jobseeker_name'
                },
                {
                    data: 'contact_number',
                    name: 'contact_number'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'datetime',
                    name: 'datetime'
                },
               
                
            ]
        });
    </script>
    <?php $__env->stopSection(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23)): ?>
<?php $component = $__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23; ?>
<?php unset($__componentOriginalc6e081c8432fe1dd6b4e43af4871c93447ee9b23); ?>
<?php endif; ?><?php /**PATH C:\wamp64\www\nammav2appweb-3\resources\views/jobs-report/details.blade.php ENDPATH**/ ?>