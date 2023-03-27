<x-master-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center p-3 flex-wrap gap-3">
                            <h5 class="font-weight-bold">{{ $pageTitle ?? __('messages.list') }}</h5>
                            <a href="{{ route('quickbooking') }}" class="float-right btn btn-sm btn-primary"><i class="fa fa-angle-double-left"></i> {{ __('messages.back') }}</a>
                            @if($auth_user->can('booking list'))
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                {{ Form::model($bookingdata,['method' => 'POST','route'=>'booking.store', 'enctype'=>'multipart/form-data', 'data-toggle'=>"validator" ,'id'=>'booking'] ) }}
                {{ Form::hidden('id') }}
                <div class="card">
                    <div class="card-header text-center">
                        <div class="row">&nbsp;&nbsp;
                            <h5 class="font-weight-bold" style="font-size:20px"> Customer Name : &nbsp;</h5>
                            <h5 class="font-weight-bold" style="font-size:20px;color:green" id="customer_name"> </h5>
                            <div class="form-group col-md-6 font-weight-bold">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_shop" id="inlineRadio1" value="1" required>
                                    <label class="form-check-label" for="inlineRadio1">Online Booking (by customer)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_shop" id="inlineRadio2" value="2" checked required>
                                    <label class="form-check-label" for="inlineRadio2">Shop Booking (by Shop)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">



                        <div class="row">

                            <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#remoteModelData">Open Modal</button> -->

                            <input type="hidden" id="customer_id" name="customer_id" value="{{$bookingdata->customer_id}}">

                            <div class="form-group col-md-4">

                                {{ Form::label('contact_number',__('messages.customer').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('contact_number',  null, ['class'=>"form-control" , 'id'=>'contact_number', 'readonly', 'rows'=>3  , 'placeholder'=> __('messages.customer') ]) }}
                                <small class="help-block with-errors text-danger"></small>

                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.service') ]).' <span class="text-danger">*</span>',['class'=>'form-control-label'],false) }}
                                <br />
                                {{ Form::select('service_id', [optional($bookingdata->service)->id => optional($bookingdata->service)->name], optional($bookingdata->service)->id, [
                                            'class' => 'select2js form-group service',
                                            'required',
                                            'id' => 'service_id',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.service') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'service']),
                                        ])
                                    }}
                            </div>

                            <div class="form-group col-md-4">
                                {{ Form::label('name', __('messages.select_name',[ 'select' => __('messages.coupon') ]),['class'=>'form-control-label']) }}
                                <br />
                                {{ Form::select('coupon_id', [optional($bookingdata->coupon)->id => optional($bookingdata->coupon)->name], optional($bookingdata->coupon)->id, [
                                            'class' => 'select2js form-group coupon',
                                            'data-placeholder' => __('messages.select_name',[ 'select' => __('messages.coupon') ]),
                                            'data-ajax--url' => route('ajax-list', ['type' => 'coupon']),
                                        ])
                                    }}
                            </div>
                            <input type="hidden" name="type" value="">
                            <input type="hidden" name="quantity" value="1">
                            <div class="form-group col-md-4">
                                {{ Form::label('date',__('messages.date').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                {{ Form::text('date',old('date'),['placeholder' => __('messages.date'),'class' =>'form-control min-datetimepicker','required']) }}
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
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="col-md-12">
                                            {{ Form::label('address',__('messages.address').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::textarea('address', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.address') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div>

                                        <div class="col-md-12">
                                            {{ Form::label('description',__('messages.description'), ['class' => 'form-control-label']) }}
                                            {{ Form::textarea('description', null, ['class'=>"form-control textarea" , 'rows'=>3  , 'placeholder'=> __('messages.description') ]) }}
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="form-control-label" for="slider_image">Before service image </label>
                                            <div class="custom-file">
                                                <input type="file" name="before_service_image" class="custom-file-input" accept="image/*">
                                                <label class="custom-file-label upload-label">{{ __('messages.choose_file',['file' =>  __('messages.image') ]) }}</label>
                                            </div>
                                            <span class="selected_file"></span>
                                        </div>

                                    </div>

                                    <!-- <div class="col-md-4">
                                        <div class="form-group col-md-12">
                                            {{ Form::label('quantity',__('messages.quantity').' <span class="text-danger">*</span>',['class'=>'form-control-label'], false ) }}
                                            {{ Form::number('quantity', null, ['min' => 0, 'step' => 'any' , 'id' =>'quantity','class'=>"form-control" , 'rows'=>3  , 'placeholder'=> __('messages.quantity') ]) }}
                                            <small class="help-block with-errors text-danger"></small>
                                        </div> 
                                    </div>  -->
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
                        </div>
                        {{ Form::submit( __('messages.save'), ['class'=>'btn btn-md btn-primary float-right']) }}
                    {{ Form::close() }}


                    </div>
                    
                </div>
            </div>
        </div>
    </div>




    @section('bottom_script')

    <script type="text/javascript">
        (function($) {
            "use strict";
            $(document).ready(function() {


                $('#estimate').val(0);
                $('#other_charge').val(0);
                $('#discount').val(0);
                $('#advance').val(0);
                var category_id = "{{ isset($bookingdata->contact_number) ? $bookingdata->contact_number : '' }}";

                getCustomer(category_id)



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
                    $('#other_charge').val(0);
                    est_calculate(value);
                })

                $(document).on('change', '#other_charge', function() {
                    $('#estimate').val(0);
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


            function getCustomer(mobile_no) {




                var get_subcategory_list = "{{ route('ajax-list', [ 'type' => 'setuser','mobile_no' =>'']) }}" + mobile_no;
                get_subcategory_list = get_subcategory_list.replace('amp;', '');

                $.ajax({
                    url: get_subcategory_list,
                    success: function(result) {
                        var datas = result.results;

                        //console.log(datas);
                        if (datas.length == 0) {
                            window.location.href = "{{ route('quickbooking') }}";

                        } else {
                            if (mobile_no != "") {
                               
                               // console.log(datas.text);
                                $('#customer_id').val(datas[0].id);
                                // $('#contact_number').val(datas[0].text);
                                $('#customer_name').html(' ' + datas[0].display_name);
                            }
                        }


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