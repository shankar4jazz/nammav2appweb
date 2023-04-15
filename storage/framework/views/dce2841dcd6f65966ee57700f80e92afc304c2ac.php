<?php echo e(Form::hidden('id', null, array('placeholder' => 'id','class' => 'form-control'))); ?>

<?php echo e(Form::hidden('type', 'hjg', array('placeholder' => 'id','class' => 'form-control'))); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e(__('messages.plan')); ?></h5>
                            <div class="table-responsive">
                                <table class="table data-table mb-0">
                                    <thead class="table-color-heading">
                                        <tr class="text-secondary">
                                            <th scope="col"><?php echo e(__('messages.planname')); ?></th>
                                            <th scope="col"><?php echo e(__('messages.planType')); ?></th>
                                            <th scope="col"><?php echo e(__('messages.plan_type')); ?></th>
                                            
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
<?php echo e(Form::close()); ?>

<script type="text/javascript">

var loadurl = '<?php echo e(route('provider_detail_pages')); ?>?tabpage=unsubscribe-plan&type=tbl&providerid=<?php echo e(request()->providerid); ?>';

    var table = $('.data-table').DataTable({
        processing: true,
          serverSide: true,

        ajax: {
            url: loadurl,
            type: 'GET'
        },
        columns: [
            {
                data: 'title',
                name: 'title'

            },
            {
                data: 'type',
                name: 'type'
            },
          
            {
                data: 'plan_type',
                name: 'plan_type'
            },
        ]
    });
</script><?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/providerdetail/unsubscribe-plan.blade.php ENDPATH**/ ?>