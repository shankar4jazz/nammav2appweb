<?php echo e(Form::hidden('id',$bookingdata->id)); ?>

<?php
$extraValue = 0;
$attachments = optional($bookingdata->service)->getMedia('service_attachment');
if(!$attachments->isEmpty()){
$image = $attachments[0]->getFullUrl();
} else {
$image = getSingleMedia(optional($bookingdata->service),'service_attachment');
}
$status = App\Models\BookingStatus::where('status',1)->orderBy('sequence','ASC')->get()->pluck('label', 'value');
?>

<div class="card-body p-0">
    <div class="border-bottom pb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
        <div>
            <h3 class="c1 mb-2"><?php echo e(__('messages.book_id')); ?> <?php echo e('#' . $bookingdata->id ?? '-'); ?></h3>
            <p class="opacity-75 fz-12">
                <?php echo e(__('messages.book_placed')); ?> <?php echo e($bookingdata->date ?? '-'); ?>

            </p>
        </div>

        <div class="d-flex flex-wrap flex-xxl-nowrap gap-3" data-select2-id="select2-data-8-5c7s">
              
            <div class="w3-third">
                <?php echo e(Form::select('status',['paid'=> __('messages.paid') ,'pending'=>__('messages.pending')],optional($bookingdata->payment)->payment_status,
                    [ 'id' => 'payment_status' , 'type'=>'payment','class' =>'form-control select2js paymentStatus', 'data-id' => $bookingdata->id])); ?>

            </div>
            <div class="w3-third">
                <?php echo e(Form::select('status', $status, $bookingdata->status, [
                        'class' =>'form-control select2js bookingstatus',
                        'data-id' => $bookingdata->id,
                        'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.status') ]),
                    ])); ?>


            </div> 
           <?php if($bookingdata->payment_id !== null): ?>
            <a href="<?php echo e(route('invoice_pdf',$bookingdata->id)); ?>" class="btn btn-primary" target="_blank">
                <i class="ri-file-text-line"></i>
                
                <?php echo e(__('messages.invoice')); ?>

            </a>
            <?php endif; ?>
        </div>

    </div>
    <div class="pay-box">
        <div class="pay-method-details">
            <h4 class="mb-2"><?php echo e(__('messages.payment_method')); ?></h4>
            <h5 class="c1 mb-2"><?php echo e(__('messages.cash_after')); ?></h5>
            <p><span><?php echo e(__('messages.amount')); ?> : </span><strong><?php echo e(!empty($bookingdata->total_amount) ? getPriceFormat($bookingdata->total_amount + $extraValue ): 0); ?></strong></p>
        </div>
        <div class="pay-booking-details">
            <div class="row mb-2">
                <div class="col-sm-6"><span><?php echo e(__('messages.booking_status')); ?> :</span></div>
                <div class="col-sm-6 align-text"><span class="c1" id="booking_status__span"><?php echo e($bookingdata->status ?? '-'); ?></span></div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6"> <span><?php echo e(__('messages.payment_status')); ?> : </span></div>
                <div class="col-sm-6 align-text">  <span class="text-success" id="payment_status__span"><?php echo e(optional($bookingdata->payment)->payment_status); ?> </div>
            </div>
            <div class="row">
                <div class="col-sm-6"> 
                    <h5>
                        <?php echo e(__('messages.booking_date')); ?> :
                    </h5>
                </div>
                <div class="col-sm-6 align-text"> 
                    <span id="service_schedule__span"><?php echo e($bookingdata->date ?? '-'); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3 d-flex gap-3 flex-wrap customer-info-detail mb-2">
        <div class="c1-light-bg radius-10 py-3 px-4 flex-grow-1">
            <h4 class="mb-2"><?php echo e(__('messages.customer_information')); ?></h4>
            <h5 class="c1 mb-3"><?php echo e(optional($bookingdata->customer)->display_name ?? '-'); ?></h5>
            <ul class="list-info">
                <li>
                    <span class="material-icons customer-info-text"><?php echo e(__('messages.phone_information')); ?></span>
                    <a href="" class="customer-info-value">
                        <p class="mb-0"><?php echo e(optional($bookingdata->customer)->contact_number ?? '-'); ?></p>
                    </a>
                </li>
                <li>
                    <span class="material-icons  customer-info-text"><?php echo e(__('messages.address')); ?></span>
                    <p class="customer-info-text"><?php echo e(optional($bookingdata->customer)->address ?? '-'); ?></p>
                </li>
            </ul>
        </div>

        <div class="c1-light-bg radius-10 py-3 px-4 flex-grow-1">
            <h4 class="mb-2"><?php echo e(__('messages.provider_information')); ?></h4>
            <h5 class="c1 mb-3"><?php echo e(optional($bookingdata->provider)->display_name ?? '-'); ?></h5>
            <ul class="list-info">
                <li>
                    <span class="material-icons customer-info-text"><?php echo e(__('messages.phone_information')); ?></span>
                    <a href="" class="customer-info-value">
                        <p class="mb-0"><?php echo e(optional($bookingdata->provider)->contact_number ?? '-'); ?></p>
                    </a>
                </li>
                <li>
                    <span class="material-icons customer-info-text"><?php echo e(__('messages.address')); ?></span>
                    <p class=" customer-info-value"><?php echo e(optional($bookingdata->provider)->address ?? '-'); ?></p>
                </li>
            </ul>
        </div>

        <div class="c1-light-bg radius-10 py-3 px-4 flex-grow-1">
            <?php if(count($bookingdata->handymanAdded) > 0): ?>
            <?php $__currentLoopData = $bookingdata->handymanAdded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h4 class="mb-2"><?php echo e(__('messages.handyman_information')); ?></h4>
            <h5 class="c1 mb-3"><?php echo e(optional($booking->handyman)->username ?? '-'); ?></h5>
            <ul class="list-info">
                <li>
                    <span class="material-icons  customer-info-text"><?php echo e(__('messages.phone_information')); ?></span>
                    <a href="" class=" customer-info-value">
                        <p class="mb-0"><?php echo e(optional($booking->handyman)->contact_number ?? '-'); ?></p>
                    </a>
                </li>
                <li>
                    <span class="material-icons  customer-info-text"><?php echo e(__('messages.address')); ?></span>
                    <p  class=" customer-info-value"><?php echo e(optional($booking->handyman)->address ?? '-'); ?></p>
                </li>
            </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <h4 class="mb-2"><?php echo e(__('messages.handyman_information')); ?></h4>
            <h5 class="mb-3">-</h5>
            <ul class="list-info">
                <li>
                    <span class="material-icons  customer-info-text"><?php echo e(__('messages.phone_information')); ?></span>
                    <a href="" class="customer-info-text">
                        <p>-</p>
                    </a>
                </li>
                <li>
                    <span class="material-icons  customer-info-text"><?php echo e(__('messages.address')); ?></span>
                    <p class="customer-info-text">-</p>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
    <h3 class="mb-3"><?php echo e(__('messages.booking_summery')); ?></h3>
    <div class="table-responsive border-bottom">
        <table class="table text-nowrap align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-lg-3"><?php echo e(__('messages.service')); ?></th>
                    <th><?php echo e(__('messages.price')); ?></th>
                    <th><?php echo e(__('messages.quantity')); ?></th>
                    <th><?php echo e(__('messages.discount')); ?></th>
                    <th class="text-end"><?php echo e(__('messages.sub_total')); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-wrap ps-lg-3">
                        <div class="d-flex flex-column">
                            <a href="" class="booking-service-link fw-bold"><?php echo e(optional($bookingdata->service)->name ?? '-'); ?></a>
                        </div>
                    </td>
                    <td><?php echo e(isset($bookingdata->amount) ? getPriceFormat($bookingdata->amount) : 0); ?></td> 
                    <td><?php echo e(!empty($bookingdata->quantity) ? $bookingdata->quantity : 0); ?></td>
                    <td><?php echo e(!empty($bookingdata->discount) ? $bookingdata->discount : 0); ?>%</td>
                    <?php
                    if($bookingdata->service->type === 'fixed'){
                    $sub_total = ($bookingdata->amount) * ($bookingdata->quantity);
                    }else{
                    $sub_total = $bookingdata->amount;
                    }
                    ?>
                    <td class="text-end"><?php echo e(!empty($sub_total) ? getPriceFormat($sub_total) : 0); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row justify-content-end mt-3">
        <div class="col-sm-10 col-md-6 col-xl-5">
            <div class="table-responsive bk-summary-table">
                <table class="table-sm title-color align-right w-100">
                    <tbody>
                        <tr>
                            <td><?php echo e(__('messages.discount')); ?> (-)</td>
                            <td class="bk-value"><?php echo e(!empty($bookingdata->discount) ? $bookingdata->discount : 0); ?>%</td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('messages.coupon')); ?> (-)</td> 
                            <?php
                            $discount = '';
                            if($bookingdata->couponAdded != null){
                                $discount = optional($bookingdata->couponAdded)->discount ?? '-';
                                $discount_type = optional($bookingdata->couponAdded)->discount_type ?? 'fixed';
                                $discount = (float)$discount;
                                if($discount_type == 'percentage'){
                                    $discount = $discount .'%';
                                }
                            }
                            ?>
                            <td class="bk-value"><?php echo e(optional($bookingdata->couponAdded)->code ?? '0'); ?> <?php echo e($discount); ?>%</td>
                        </tr>
                        <tr>
                            <td><?php echo e(__('messages.tax')); ?></td>

                            <?php
                            if($bookingdata->tax != ""){
                            foreach(json_decode($bookingdata->tax) as $key => $value){
                                if($value->type === 'percent'){
                                    $tax = $value->value;
                                    $tax_per = $sub_total * $tax / 100;
                                }else{
                                    $tax_fix = $value->value;
                                }
                            }
                            
                            $tax_amount = $tax_per ?? 0 + $tax_fix ?? 0;
                        }else{
                            $tax_amount =0;
                        }
                     
                            ?>
                            <td class="bk-value"><?php echo e(!empty($tax_amount) ? getPriceFormat($tax_amount) : 0); ?></td>
                        </tr>
                        <tr class="grand-sub-total">
                            <td><?php echo e(__('messages.subtotal_vat')); ?></td>
                            <?php
                            $sub_total = $bookingdata->amount + $tax_amount;
                            ?>
                            <td class="bk-value"><?php echo e(!empty($sub_total) ? getPriceFormat($sub_total) : 0); ?></td>
                        </tr>
                        <tr class="grand-total">
                            <td><strong><?php echo e(__('messages.grand_total')); ?></strong></td>
                            <td class="bk-value">
                                <?php
                                $coupon_discount = $sub_total * (float)$discount / 100;
                                $discount = $sub_total * $bookingdata->discount / 100;
                                $total_amount = $sub_total - ($coupon_discount + $discount);
                                ?>
                                <h3><?php echo e(!empty($total_amount) ? getPriceFormat($total_amount) : 0); ?></h3>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>

$(document).on('change','.bookingstatus', function() {

    var status = $(this).val();

    var id = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "<?php echo e(route('bookingStatus.update')); ?>",
        data: { 'status': status, 'bookingId': id  },
        success: function(data){
        }
    });
})

$(document).on('change','.paymentStatus', function() {

var status = $(this).val();

var id = $(this).attr('data-id');
$.ajax({
    type: "POST",
    dataType: "json",
    url: "<?php echo e(route('bookingStatus.update')); ?>",
    data: { 'status': status, 'bookingId': id  },
    success: function(data){
    }
});
})
</script>
<?php /**PATH C:\wamp64\www\nammav2appweb\resources\views/booking/info.blade.php ENDPATH**/ ?>