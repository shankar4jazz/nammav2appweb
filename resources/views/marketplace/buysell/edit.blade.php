<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                            <a href="{{ route('booking.index') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('booking list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($bookingdata,['method' => 'patch', 'enctype'=>'multipart/form-data', 'route'=>['booking.update',$bookingdata->id], 'data-toggle'=>"validator" ,'id'=>'booking'] ) }}
                        {{ Form::hidden('id') }}
                        <div class="row">
                            <div class="form-group col-md-4">

                                {{ Form::label('status', __('messages.select_name',[ 'select' => __('messages.status') ]),['class'=>'form-control-label']) }}
                                <br />
                                {{ Form::select('status',$status,old('status'),[ 'id' => 'status' ,'class' =>'form-control select2js booking_status']) }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('date',__('messages.date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('date',old('date'),['placeholder' => __('messages.date'),'class' =>'form-control datetimepicker','required']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('start_at',__('messages.start_at'),['class'=>'form-control-label']) }}
                                {{ Form::text('start_at',old('start_at'),['placeholder' => __('messages.start_at'),'class' =>'form-control datetimepicker']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('end_at',__('messages.end_at'),['class'=>'form-control-label']) }}
                                {{ Form::text('end_at',old('end_at'),['placeholder' => __('messages.end_at'),'class' =>'form-control datetimepicker']) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('serial_no',__('messages.serial_no').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('serial_no', null, ['class'=>"form-control" , 'rows'=>3 , 'placeholder'=> __('messages.serial_no') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('model',__('messages.model').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('model', null, ['class'=>"form-control" , 'rows'=>3 , 'placeholder'=> __('messages.model') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('brand',__('messages.brand').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('brand', null, ['class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.brand') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('issue',__('messages.issue').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('issue', null, ['class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.issue') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('extra_items',__('messages.extra_items').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('extra_items', null, ['class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.extra_items') ]) }}
                                <small class="help-block with-errors text-danger"></small>
                            </div>
                            @if($bookingdata->payment_id != null)
                            <div class="form-group col-md-4">
                                {{ Form::label('payment_status',__('messages.payment_status').' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                {{ Form::select('payment_status',['pending' => __('messages.pending') , 'paid' => __('messages.paid') ,'failed' => __('messages.failed') ],optional($bookingdata->payment)->payment_status,[ 'id' => 'payment_status' ,'class' =>'form-control select2js','required']) }}
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ]) }}
                            </div>
                            <div class="form-group col-md-6 reason">
                                {{ Form::label('reason',__('messages.reason'), ['class' => 'form-control-label']) }}
                                {{ Form::textarea('reason', null, ['class'=>"form-control textarea" , 'rows' => 3, 'placeholder'=> __('messages.reason') ]) }}
                            </div>
                        </div>
                        <div class="row gx-5 align-items-center">

                            <div class="form-group col col-md-6">
                                <label class="form-control-label" for="before_service_image">Before service image </label>
                                <div class="custom-file">
                                    <input type="file" name="before_service_image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                </div>
                            </div>

                            @if(getMediaFileExit($bookingdata, 'before_service_image'))
                            <div class="col-md-2 mb-5">
                                <img id="before_service_image_preview" src="{{getSingleMedia($bookingdata,'before_service_image')}}" alt="#" class="attachment-image mt-1">
                                <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $bookingdata->id, 'type' => 'before_service_image']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" data-toggle="tooltip" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif

                            <div class="form-group col col-md-6">
                                <label class="form-control-label" for="after_service_image">After service image </label>
                                <div class="custom-file">
                                    <input type="file" name="after_service_image" class="custom-file-input" accept="image/*">
                                    <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                </div>
                            </div>

                            @if(getMediaFileExit($bookingdata, 'after_service_image'))
                            <div class="col-md-2 mb-3">
                                <img id="after_service_image_preview" src="{{getSingleMedia($bookingdata,'after_service_image')}}" alt="#" class="attachment-image mt-1">
                                <a class="text-danger remove-file" href="{{ route('remove.file', ['id' => $bookingdata->id, 'type' => 'after_service_image']) }}" data--submit="confirm_form" data--confirmation='true' data--ajax="true" data-toggle="tooltip" title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-title='{{ __("messages.remove_file_title" , ["name" =>  __("messages.image") ]) }}' data-message='{{ __("messages.remove_file_msg") }}'>
                                    <i class="ri-close-circle-line"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <input type="hidden" id="service_amt" value="">
                                        {{ Form::label('estimate',__('messages.estimate').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('estimate', null, ['min' => 0, 'step' => 'any' , 'id' =>'estimate','class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.estimate') ]) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        {{ Form::label('other_charge',__('messages.other_charge').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('other_charge', null, ['min' => 0, 'step' => 'any' , 'id' =>'other_charge', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.other_charge') ]) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        {{ Form::label('discount',__('messages.discount').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('discount_amount', null, ['min' => 0, 'step' => 'any' , 'id' =>'discount', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.discount') ]) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>

                                    <div class="form-group col-md-12">
                                        {{ Form::label('sub_amount',__('messages.sub_amount').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('amount', null, ['readonly', 'class'=>"form-control" , 'rows'=>3  , 'min' => 0, 'step' => 'any' , 'id' =>'sub_amount', 'placeholder'=> __('messages.sub_amount') ]) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>

                                    <div class="form-group col-md-12">
                                        {{ Form::label('advance',__('messages.advance').' <span class="text-danger"></span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('advance', null, ['min' => 0, 'step' => 'any' , 'id' =>'advance', 'class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.advance') ]) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                    <div class="form-group col-md-12">
                                        {{ Form::label('amount',__('messages.amount').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                        {{ Form::number('total_amount', null, ['readonly','class'=>"form-control" , 'rows'=>3  , 'min' => 0, 'step' => 'any' , 'id' =>'amount', 'placeholder'=> __('messages.amount') ]) }}
                                        <small class="help-block with-errors text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('bottom_script')
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {
                // $('#status').attr("disabled", "true");

                /*  changeReason(status);

                 $("#status").change(function() {
                     changeReason(this.value)
                 });

                 function changeReason(status)
                 {
                     if (jQuery.inArray(status, ['hold', 'in_progress','failed']) !== -1) {
                         $('.reason').removeClass('d-none');
                     }else{
                         $('.reason').addClass('d-none');
                     }
                 } */
            });
        })(jQuery);

        (function($) {
            "use strict";
            $(document).ready(function() {


                // var category_id = "{{ isset($bookingdata->service_id) ? $bookingdata->service_id : '' }}";





                //getSubCategory(category_id)



                // $(document).on('change', '#service_id', function() {
                //     var category_id = $(this).val();
                //     $('#subcategory_id').empty();
                //     getSubCategory(category_id);
                // })

                // $(document).on('change', '#quantity', function() {
                //     var value = $(this).val();
                //     qtycalculate(value);
                // })

                $(document).on('change', '#estimate', function() {
                    var value = $(this).val();
                    est_calculate(value);
                })

                $(document).on('change', '#other_charge', function() {
                    var value = $(this).val();
                    other_calculate(value);
                })

                $(document).on('change', '#discount', function() {
                    var value = $(this).val();
                    discount_calculate(value);
                })

                $(document).on('change', '#advance', function() {
                    var value = $(this).val();
                    advance_calculate(value);
                })

            });



            function advance_calculate(advance) {


                var discount = $('#discount').val();
                var estimate = $('#estimate').val();
                var other_amt = $('#other_charge').val();
                var price = parseInt(estimate) + parseInt(other_amt);

                var subtotal = price - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                //console.log(total);
                $('#amount').val(total.toFixed(2));

            }

            function other_calculate(other_amt) {

                var advance = $('#advance').val();
                var discount = $('#discount').val();
                var estimate = $('#estimate').val();
                var price = parseInt(estimate) + parseInt(other_amt);

                var subtotal = price - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                $('#amount').val(total.toFixed(2));

            }

            function discount_calculate(dis_amt) {

                var estimate = $('#estimate').val();
                var other_amt = $('#other_charge').val();
                var price = parseInt(estimate) + parseInt(other_amt);

                // var total = price - dis_amt;
                // $('#sub_amount').val(total.toFixed(2));
                // $('#amount').val(total.toFixed(2));

                var advance = $('#advance').val();

                var subtotal = price - dis_amt;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                $('#amount').val(total.toFixed(2));

            }



            function est_calculate(value) {

                var estimate = value;
                var other_amt = $('#other_charge').val();
                var discount = $('#discount').val();

                var price = parseInt(estimate) + parseInt(other_amt);


                // var total = price - discount;

                // $('#sub_amount').val(total.toFixed(2));
                // $('#amount').val(total.toFixed(2));

                var advance = $('#advance').val();

                var subtotal = price - discount;
                $('#sub_amount').val(subtotal.toFixed(2));
                var total = subtotal - advance;
                $('#amount').val(total.toFixed(2));

            }




            function getSubCategory(category_id) {

                var get_subcategory_list = "{{ route('ajax-list', [ 'type' => 'servicedetails','service_id' =>'']) }}" + category_id;
                get_subcategory_list = get_subcategory_list.replace('amp;', '');

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        var data = result.results;
                        data.forEach(function(value) {
                            //$('#estimate').val(value.price);
                            //$('#service_amt').val(value.price);                           
                            $('#discount').val(0);
                            $('#other_charge').val(0)

                            //var discount = value.discount / 100;
                            //var total = value.price - (value.price * discount);

                            // $('#sub_amount').val(total.toFixed(2));
                            // $('#amount').val(total.toFixed(2));
                        });
                        // if (subcategory_id != "") {
                        //     $('#subcategory_id').val(subcategory_id).trigger('change');
                        // }
                    }
                });
            }

        })(jQuery);
    </script>

    @endsection
</x-master-layout>